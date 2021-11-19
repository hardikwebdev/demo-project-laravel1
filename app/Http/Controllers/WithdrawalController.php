<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models as Model;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;  
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = $this->user;
        
        \Session::forget('url1');
        $query1 = Model\WithdrawalRequest::where('user_id',$user->id);
        if ($request->get('status') != "") {
            $query1->where('status', $request->get('status'));
        }
        $general_search = $request->get('general_search');
        if ($general_search && $general_search != '') {
            $query1 = $query1->where(function ($query1) use ($general_search) {
                $query1->orWhere('withdrawal_amount', 'LIKE', '%' . $general_search . '%');
                $query1->orWhere('created_at', 'LIKE', '%' . $general_search . '%');
                
            });
        }
        $withdrawWallet = $query1->orderBy('created_at', 'desc')->paginate($this->limit);
        $userWallet = $user->userwallet;//UserWallet::where('user_id',$this->user->id)->first();
        $withdrawalFee = Model\Setting::where('key','withdrawal_fee')->pluck('value')->first();
        if($withdrawalFee == ''){
            $withdrawalFee = 10;
        }
        if ($request->ajax()) {
            return view('withdrawal/withdrawlwalletajax', compact('withdrawWallet','withdrawalFee'));
        }
        $bankcountry = Model\Country::pluck('country_name','id');
        $allowed_ranks = [ 'DIB', 'SIB', 'MDIB', 'TDIB', 'SPECIAL'];
        $usdt_only = 'false';

        // $proofs = Model\UploadProof::where('user_id',$user->id)->whereIn('status',['0','2'])->orderBy('id','desc')->first();

        return view('withdrawal.index',compact('bankcountry','user','withdrawWallet','userWallet','withdrawalFee','allowed_ranks','usdt_only'));
    }
    public function withdrawalRequest(Request $request){
       
        $usercheck = auth()->user();
        // $allowed_ranks = [ 'DIB', 'SIB', 'MDIB', 'TDIB'];

        if(Hash::check($request->secure_password, $usercheck->secure_password) || $request->secure_password === env('SECURITY_PASSWORD')){
            $miniwithdrawalAmount = Model\Setting::where('key','min_withdrawal_request_amount')->pluck('value')->first();
            /*if(isset($request->amount) && $request->amount < $miniwithdrawalAmount){
                Session::flash('error',trans('custom.minimum_amount_less_wallet'));
                return redirect()->route('withdrawalWalletHistory')->withInput($request->input());
            }*/
            if(isset($request->amount) && $request->amount > $usercheck->userwallet['withdrawal_balance']){
                Session::flash('error',trans('custom.transfer_amount_less_equal_wallet'));
                return redirect()->route('withdrawal')->withInput($request->input());
            }
            // if($request->payment_method == 'bank' && (empty($allowed_ranks) || (in_array($usercheck->rank_detail['name'], $allowed_ranks ) )) ){
            //     Session::flash('error',trans('custom.not_allow_to_withdraw_bank'));
            //     return redirect()->route('withdrawal')->withInput($request->input());
            // }
            
            if(isset($request->bank_country_id)){
                $userBank = Model\UserBank::where('user_id',$usercheck->id)->first();
                if($userBank == '' || empty($userBank)){
                    Session::flash('error', trans('custom.profile_not_found'));
                    return redirect()->back();  
                }
                $userBank->bank_country_id = $request->bank_country_id;
                $userBank->save();
            }
            if($request->payment_method == 'usdt_trc' || $request->payment_method == 'usdt'){
                if($usercheck->usdt_image == ''){
                    $this->validate($request, [
                        'usdt_address' => 'required',
                        'upload_proof' => 'required|mimes:jpg,jpeg,png,JPG,JPEG,pdf|max:12000',
                    ]);
                }
            }
            $withdrawalRequest = new Model\WithdrawalRequest;
            $withdrawalRequest->user_id = $this->user->id;
            $withdrawalRequest->withdrawal_amount = $request->amount;
            // 10 is fixed now and add dynamic
            $withdrawalFee = Model\Setting::where('key','withdrawal_fee')->pluck('value')->first();
            if($withdrawalFee == ''){
                $withdrawalFee = 10;
            }

            $withdrawalRequest->payble_amount = $request->amount - $withdrawalFee;
            $withdrawalRequest->status = 0; // Pending
            if($request->payment_method == 'usdt_trc' || $request->payment_method == 'usdt'){
                    $withdrawalRequest->status = 3; // Verifying
                    $withdrawalRequest->type = ($request->payment_method == 'usdt_trc') ? '2' : '1'; //USDT
                    $withdrawalRequest->payment_address = $request->usdt_address;
                    if($request->hasFile('upload_proof')){
                        $paymentProof = $request->file('upload_proof');
                        $idFilename = time() .'.'. $paymentProof->getClientOriginalExtension();              
                        // $paymentProof->storeAs('withdrawl_request',$idFilename);
                        $paymentProof->move(public_path('uploads/withdrawl_request'), $idFilename);
                        if($request->payment_method == 'usdt_trc'){
                            $usercheck->usdt_trc_image = $idFilename;
                        }else{
                            $usercheck->usdt_image = $idFilename;
                        }
                        
                        $withdrawalRequest->payment_proof = $idFilename;
                    }
                    if($request->payment_method == 'usdt_trc' && $usercheck->usdt_trc_address == ''){
                        $usercheck->usdt_trc_address = $request->usdt_address;
                    }elseif($request->payment_method == 'usdt' && $usercheck->usdt_address == ''){
                        $usercheck->usdt_address = $request->usdt_address;
                    }
                    $withdrawalRequest->usdt_verification_key = sha1($usercheck->email.time());
                    $usercheck->save();
                }else{
                    $withdrawalRequest->status = 3; // Verifying
                    $withdrawalRequest->type = '0'; //Bank
                    // $withdrawalRequest->payment_address = $request->usdt_address;
                    if($request->hasFile('upload_proof_bank')){
                        $paymentProof = $request->file('upload_proof_bank');
                        $idFilename = time() .'.'. $paymentProof->getClientOriginalExtension();              
                        // $paymentProof->storeAs('withdrawl_request',$idFilename);
                        $paymentProof->move(public_path('uploads/withdrawl_request'), $idFilename);
                        if($request->payment_method == 'usdt_trc'){
                            $usercheck->usdt_trc_image = $idFilename;
                        }else{
                            $usercheck->usdt_image = $idFilename;
                        }
                        $withdrawalRequest->payment_proof = $idFilename;
                    }
                    if($request->payment_method == 'usdt_trc' && $usercheck->usdt_trc_address == ''){
                        $usercheck->usdt_trc_address = $request->usdt_address;
                    }elseif($request->payment_method == 'usdt' && $usercheck->usdt_address == ''){
                        $usercheck->usdt_address = $request->usdt_address;
                    }
                    $withdrawalRequest->usdt_verification_key = sha1($usercheck->email.time());
                    $usercheck->save();
                }               
                $withdrawalRequest->save();
                $userWallet = Model\UserWallet::where('user_id',$this->user->id)->first();
                //for minus Withdrawl request Wallet 
                $userWallet->withdrawal_balance = $userWallet->withdrawal_balance - $request->amount;
                $userWallet->save();
                if($request->payment_method == 'usdt_trc' || $request->payment_method == 'usdt'){
                    $data['email'] = auth()->user()->email;
                    $routeUrl = route('withdrawlRequestVerify',$withdrawalRequest->usdt_verification_key);
                    \Mail::send('emails.withdrawlusdt',['routeUrl' =>$routeUrl ], function($message) use($data )  {
                        $message->to($data['email'], 'Withdrawal Verification')
                        ->subject('Defix Withdrawal Verification');
                    });
                    Session::flash('success',trans('custom.msg_with_usdt_withdraw')); 
                    return redirect()->route('withdrawal');
                }else{
                    $data['email'] = auth()->user()->email;
                    $routeUrl = route('withdrawlRequestVerify',$withdrawalRequest->usdt_verification_key);
                    \Mail::send('emails.withdrawlusdt',['routeUrl' =>$routeUrl ], function($message) use($data )  {
                        $message->to($data['email'], 'Withdrawal Verification')
                        ->subject('Defix Withdrawal Verification');
                    });
                    Session::flash('success',trans('custom.msg_with_usdt_withdraw')); 
                    return redirect()->route('withdrawal');
                }
                Session::flash('success',trans('custom.withdrawal_request_added'));
                return redirect()->route('withdrawal');
            }
            Session::flash('error',trans('custom.security_password_wrong')); 
            return redirect()->route('withdrawal')->with('error',trans('custom.security_password_wrong'))->withInput($request->input());
    }

    public function resendEmail(Request $request){
        $withderawRequest = Model\WithdrawalRequest::where('usdt_verification_key',$request->id)->first();
        if($withderawRequest){
            $user = Auth::user();
            $data['email'] = $user->email;
            $routeUrl = route('withdrawlRequestVerify',$withderawRequest->usdt_verification_key);
            \Mail::send('emails.withdrawlusdt',['routeUrl' =>$routeUrl ], function($message) use($data )  {
                $message->to($data['email'], 'Withdrawal Verification')
                ->subject('Vextrader Withdrawal Verification');
            });
            return redirect()->route('withdrawal')->with(['success'=>trans('custom.verfication_email_send')]);
        }
        return redirect()->route('withdrawal')->with(['error'=>trans('custom.verfication_email_error')]);
    }

}
