<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserBank;
use App\Models\UserAgreement;
use App\Models\UserWallet;
use App\Helpers\Helper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
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
            'signature' => $data['signature'],
            // 'iagree' => (isset($data['iagree'])) ? 1 : "0",
            // 'registered_date' => $data['d_date'],
            // 'terms_condition' => $terms_condition,
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
        // if(isset($data['terms_condition'])){
        //     $userAgreement = UserAgreement::create([
        //         'user_id' => $user->id,
        //         'aml_policy_statement' => (in_array('aml_policy_statement', $terms_condition)) ? 1 : 0,
        //         'risk_disclosure_statement' => (in_array('risk_disclosure_statement', $terms_condition)) ? 1 : 0,
        //         'user_agreement' => (in_array('client_agreement', $terms_condition)) ? 1 : 0,
        //         'poa' => (in_array('poa', $terms_condition)) ? 1 : 0,
        //         'user_signature' => $data['fullname'],
        //         'date_of_registration' => date('Y-m-d'),
        //     ]);
        // }

        $UserWallet = UserWallet::create([
            'user_id' => $user->id,
        ]);
        Helper::updateDownline($user->id);
        $routeUrl = route('login');
        \Mail::send('emails.welcome-email',['routeUrl' =>$routeUrl, 'user' => $user], function($message) use($data )  {
            $message->to($data['email'], 'Welcome')
            ->subject('Defix Welcome');
        });
        return $user;        
    }
}
