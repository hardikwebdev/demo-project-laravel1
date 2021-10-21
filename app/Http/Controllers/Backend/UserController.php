<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Country;
use App\Models\UserBank;
use Illuminate\Http\Request;
use App\Models\UserAgreement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $counties = Country::orderBy('country_name','asc')->pluck('country_name','id'); 
        return view('backend.users.create',compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            /* validation start */
            $rules = [
                'username' => 'required|string|unique:users|max:255|alpha_num',
                'email' => 'required|email|unique:users|max:255',
                'sponsor' => ['required', 'string', 'max:255','exists:users,username'],
                'password' => 'required',
                'retype_password' => 'required',
                'secure_password' => 'required',
                'retype_secure_password' => 'required',
                'ic_number' => 'required',
                'name' => 'required|max:255',
                'address' => 'required',
                'country' => 'required',
                'city' => 'required',
                'state' => 'required',
                'signature' => 'required',
                'name' => 'required',
                'branch' => 'required',
                'acc_holder_name' => 'required|same:name',
                'acc_number' => 'required',
                'swift_code' => 'required',
                'terms_condition' => 'required',
                'bank_country_id' => 'required',
            ];
            if($request->country =='131'){
                $rules['ic_number'] = 'max:12';
            }
            $validatedData = $request->validate($rules);
            /* validation end */

            $data = $request->all();   
            $count = User::where('identification_number',$request->ic_number)->where(['status'=>'active'])->count();
            if($count >= 3){
                $validator = Validator::make([], []);
                $validator->getMessageBag()->add('ic_number', trans('custom.max_3_identfication_allowed'));
                return redirect()->back()->withErrors($validator)->withInput();;
            }     
        //     if(Helper::ic_number_verification($data['ic_number'],$data['sponsor']) == true){
        //     $validator = Validator::make([], []);
        //     $validator->getMessageBag()->add('ic_number',  trans('validation.unique',['attribute'=>'identification number']));
        //     return redirect()->back()->withErrors($validator)->withInput();
        //         // return response()->json(['success' => false, 'message' => trans('validation.unique',['attribute'=>'identification number']), "code" => 400], 400); 
        // }
        $terms_condition = $request->terms_condition;
        $securePassword = md5($data['secure_password']);
        $sponsor_id = User::where('username',$data['sponsor'])->where('status','active')->first();

        $user = User::firstOrCreate([
            'name' => $data['name'],
            'sponsor_id' => ($sponsor_id != null ) ? $sponsor_id->id : '0',
            'username' => $data['username'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country_id' => $data['country'],
            'identification_number' => $data['ic_number'],
            'phone_number' => $data['phone_number'],
            'secure_password' => $securePassword,            
            'email' => $data['email'],
            // 'password' => md5($data['password']),
            'password' => Hash::make($data['password']),
            'signature'=>$data['signature'],
            // 'member_group'=>($sponsor_id != null ) ? $sponsor_id->member_group : '0',
            // 'is_consultant' => $request->filled('is_consultant'),
            // 'is_investor' => $request->filled('is_investor'),
            // 'fixed_rank' => $request->filled('is_consultant'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
            // print_r($user);die();

        // if($request->mt4_id && $request->mt4_password && $request->mt4_id!="" && $request->mt4_password!=""){
        //     $user->mt4_user_id = $request->mt4_id;
        //     $user->mt4_password = $request->mt4_password;
        // }
        // if($request->filled('is_consultant')){
        //     $rank = Model\Rank::where('name','Consultant')->first();
        //     $user->rank_id = ($rank) ? $rank->id : 0;
        // }
        $userBank = UserBank::create([
            'user_id' => $user->id,
            'name' => $data['bank_name'],
            'branch' => $data['branch'],
            'account_holder' => $data['acc_holder_name'],
            'account_number' => $data['acc_number'],
            'swift_code' => $data['swift_code'],
            'bank_country_id' => $data['bank_country_id'],
        ]);
        $userAgreement = UserAgreement::create([
            'user_id' => $user->id,
            'aml_policy_statement' => (in_array('aml_policy_statement', $terms_condition)) ? 1 : 0,
            'risk_disclosure_statement' => (in_array('risk_disclosure_statement', $terms_condition)) ? 1 : 0,
            'user_agreement' => (in_array('client_agreement', $terms_condition)) ? 1 : 0,
            'poa' => (in_array('poa', $terms_condition)) ? 1 : 0,
            'user_signature' => $data['signature'],
            'date_of_registration' => date('Y-m-d H:i:s'),
        ]);
        // $UserWallet = UserWallet::create([
        //     'user_id' => $user->id,
        // ]);
        $user->save();
        // Helper::updateDownline($user->id);
        return redirect()->route('user.index')->with(['success'=>'Customer added sucessfully.']);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
