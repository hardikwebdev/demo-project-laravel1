<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserBank;
use App\Models\UserAgreement;
use App\Models\UserWallet;
use App\Helpers\Helper;
use App\Models\User,Auth;
use App\Models\StackingPool;
use App\Models\PairingCommission;
use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Setting;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /* add member view */
    public function addmember(){
        $userName = auth()->user()->username;
        $country  = Country::pluck('country_name','id')->toArray();

        return view('accounts.register',compact('userName','country'));

    }

    /* validate user */
    protected function validator(array $data)
    {
        $rules = [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','alpha_num'],
            'sponsor_username' => ['required', 'string', 'max:255','exists:users,username'],
            'placement_username' => ['required', 'string', 'max:255','exists:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','same:password_confirmation'],
            'ic_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            'country' => 'required',
            'city' => 'required',
            'ic_number' => 'required',
            'phone_number' => 'required',
            'secure_password' => 'required|same:confirm_secure_password',
            'bank_name' => 'required',
            'acc_holder_name' => 'required|same:fullname',
            'swift_code' => 'required',
            'bank_branch' => 'required',
            'acc_number' => 'required',
            'bank_country_id' => 'required',
            'child_position' => 'required',

            // 'terms_condition' => 'required|array|min:4',
            // 'iagree' => 'required',

        ];

        // if($data['country'] == '131'){
        //     $rules['ic_number'] = 'max:12';
        // }
        $usernameExits = User::where('username',$data['placement_username'])->where('status',1)->exists();
        $isValid = false;
        if ($usernameExits != null) {
            $placement = User::where('username',$data['placement_username'])->where('status',1)->first();
            $placementCount = User::where('placement_id',$placement->id)->where('status',1)->where('child_position',$data['child_position'])->count();
            if($placementCount > 0){
                $isValid = false;
            }
            $user = User::where('username',$data['sponsor_check'])->where('status',1)->first();
            // $user_reference = UserReferral::where('user_id',$user->id)->first();
            // $upline_ids = $user_reference!=null?(array)$user_reference->downline_ids:[];
            $upline_ids = Helper::getAllDownlineIds($user->id);

            $isValid = false;

            if($placementCount == 0 && $placement && (in_array($placement->id, $upline_ids) || empty($upline_ids) || $placement->username == $user->username)){
                $isValid = true;
            }

        } else {
            $isValid = false;
        }
        $validator = Validator::make($data, $rules);
        $validator->after(function($validator) use ($isValid)
        {
            if (!$isValid)
            {
                $validator->errors()->add('placement_username', 'Invalid placement position');
            }
        });

        return $validator;
    }

    /* Create user */
    protected function create(array $data)
    {
        // echo "<pre>";
        // print_r($data);die();
         $terms_condition = [];
        if(isset($data['terms_condition'])){
            $terms_condition = $data['terms_condition'];
        }
    
        \Log::channel('authlog')->debug($data);
        
        $securePassword = Hash::make($data['secure_password']);
        $sponsor_id = User::where('username',$data['sponsor_username'])->where('status','active')->first();
        $placement_id = User::where('username',$data['placement_username'])->where('status','active')->first();


       $user = User::create([
            'name' => $data['fullname'],
            'sponsor_id' => ($sponsor_id != null ) ? $sponsor_id->id : '0',
            'placement_id' => ($placement_id != null ) ? $placement_id->id : '0',
            'child_position' => $data['child_position'],
            'username' => $data['username'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country_id' => $data['country'],
            'identification_number' => $data['ic_number'],
            'phone_number' => $data['phone_number'],
            'secure_password' => $securePassword,
            // 'signature' => $data['signature'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $userBank = UserBank::create([
            'user_id' => $user->id,
            'name' => $data['bank_name'],
            'branch' => $data['bank_branch'],
            'account_holder' => $data['acc_holder_name'],
            'account_number' => $data['acc_number'],
            'swift_code' => $data['swift_code'],
            'bank_country_id' => $data['bank_country_id'],
        ]);

        $UserWallet = UserWallet::create([
            'user_id' => $user->id,
        ]);
        Helper::updateDownline($user->id);
        return $user;        
    }

    /* add new member */
    public function createMember(Request $request){
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        // \Mail::send('emails.welcome-email', ['user'=>(object)$input,'title'=>"Welcome to Defix Finance"], function($message) use($user)  {
        //     $message->to($user->email,"Defix Finance")->subject("Welcome to Defix Finance");                      
        // });
        return redirect('/')->with(['success' => trans('auth.success_register')]);

    }

    /* network tree */
    public function node_management(Request $request){

        $pairingHistory = PairingCommission::where('user_id',$this->user->id)->paginate(1);
        if ($request->ajax()) {
            return view('accounts.pairing_history', compact('pairingHistory'));
        }

        $referral = Helper::getAllDownlineIds($this->user->id);
        $referral = array_merge($referral, [$this->user->id]);
        $users    = User::whereIn('id',$referral)->where('status','active')->select('id as key','username as name','placement_id as parent','profile_image')->orderBy('child_position','asc')->get()->toArray();

        $accumulateLeftSale     = Helper::getTotalgroupsalesLeft($this->user);
        $accumulateRightSale    = Helper::getTotalgroupsalesRight($this->user);
        $todaysLeftSale         = Helper::getTotalgroupsalesTodayLeft($this->user);
        $todaysRightSale        = Helper::getTotalgroupsalesTodayRight($this->user);
        $todaysLeftCarryFw      = ($todaysLeftSale > $todaysRightSale) ? ($todaysLeftSale - $todaysRightSale) : 0;
        $todaysRightCarryFw     = ($todaysRightSale > $todaysLeftSale) ? ($todaysRightSale - $todaysLeftSale) : 0;
        $dailyMaxCommission     = Setting::where('key','_direct_pairing_limit')->value('value');
        $dailyMaxCommission     = ($dailyMaxCommission > 0) ? $dailyMaxCommission : 0;

        $totalCommission        = Helper::getTotalgroupsales($this->user);


        $allDownlineids = Helper::getAllDownlineIdsLeft($this->user->id,1);
        $saleLeft               = StackingPool::select(DB::raw("sum(amount) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->groupBy('year')->get()->toArray();

        $allDownlineids = Helper::getAllDownlineIdsRight($this->user->id,1);
        $saleRight              = StackingPool::select(DB::raw("sum(amount) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->groupBy('year')->get()->toArray();

        $allDownlineids = Helper::getAllDownlineIds($this->user->id,1);
        $graphData              = PairingCommission::select(DB::raw("sum(pairing_commission) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->whereIn('user_id',$allDownlineids)->groupBy('year')->get()->toArray();

        /* get last 12 month series */
        $start = Carbon::today()->subMonths(12);
        $i = 0;
        foreach (CarbonPeriod::create($start, '1 month', Carbon::today()) as $month) {
            $months[] = $month->format('Y-m');
            $i++;
        }

        /* collect series data for each month */
        $graph['sale_left'] = [];
        $graph['sale_right'] = [];
        $graph['pairing_commission'] = [];

        foreach ($months as $key => $month) {
            foreach($saleLeft as $sale){
                if($sale['year'] == $month){
                    $graph['sale_left'][] = $sale['amount'];
                }else{
                    $graph['sale_left'][] = 0;
                }
            }
            foreach($saleRight as $sale){
                if($sale['year'] == $month){
                    $graph['sale_right'][] = $sale['amount'];
                }else{
                    $graph['sale_right'][] = 0;
                }
            }
            foreach($graphData as $sale){
                if($sale['year'] == $month){
                    $graph['pairing_commission'][] = $sale['amount'];
                }else{
                    $graph['pairing_commission'][] = 0;
                }
            }
        }
        // echo "<pre>";
        // print_r(json_encode($saleLeft));
        // print_r(json_encode($months));
        // print_r(json_encode($graphData));
        // die();

        return view('accounts.network',compact('users','accumulateLeftSale','accumulateRightSale','todaysLeftSale','todaysRightSale','todaysLeftCarryFw','todaysRightCarryFw','dailyMaxCommission','totalCommission','graph','months','pairingHistory'));
    }
}