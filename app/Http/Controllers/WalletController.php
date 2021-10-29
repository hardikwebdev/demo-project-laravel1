<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models as Model;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function cryptoWallets(Request $request){
        $user = Auth::user()->get();
        $userWallet = Model\UserWallet::firstOrCreate(['user_id'=>$this->user->id]);
        $convertedRateUSDT = Model\Setting::where('key','bank_usdt_amount')->value('value');
        $query = Model\CryptoWallet::where('user_id',$this->user->id);
        if ($request->get('spagination') != "") {
            $this->limit = $request->get('spagination');
        }
        if ($request->get('type') != "") {
            $query->where('type', $request->get('type'));
        }
        if ($request->get('status') != null) {
            $query->where('status', $request->get('status'));
        }
        $general_search = $request->get('general_search');
        if ($general_search && $general_search != '') {
            $query = $query->where(function ($query) use ($general_search) {
                // $query->where('type', 'LIKE', '%' . $general_search . '%');
                $query->orWhere('amount', 'LIKE', '%' . $general_search . '%');
            });
        }
        $cryptowallet = $query->orderBy('created_at', 'desc')->paginate($this->limit);
        if ($request->ajax()) {
            return view('crypto_wallet/crypto_walletajax', compact('cryptowallet'));
        }
        $convertedRateMYR = 0;
        if(Auth::user()->country_id == '131'){
            $convertedRateMYR = Model\Setting::where('key','bank_myr_amount')->value('value');
        }
        return view('crypto_wallet.index', compact('convertedRateUSDT', 'convertedRateMYR', 'cryptowallet', 'userWallet'));
    }
    public function cryptoWalletForm(Request $request){
            $usercheck = Model\User::where('id',$this->user->id)->where('status','active')->first();
            $isError = 0;
            if($usercheck != null){
                $todayDate = date('Y-m-d');
                if(Hash::check($request->security_password, $usercheck->secure_password)){
                    // FundWallet::where('user_id',$this->user->id)->where('status',0)->whereIn('type',['4','1','2'])->update(['status'=>2]);
                    $fundwalletCheck = Model\CryptoWallet::where('user_id',$this->user->id)->where('status',0)->whereIn('type',['0',])->get();
                    if(count($fundwalletCheck) && Auth::user()->country_id != '45'){
                        Session::flash('error',trans('custom.previous_request_pending'));
                        return redirect()->route('crypto_wallets')->withInput($request->input());
                    }
                    if(count($fundwalletCheck) && Auth::user()->country_id == '45'){
                        $error_msg = trans('custom.previous_request_pending');
                        Session::flash('error',trans('custom.previous_request_pending'));

                        return json_encode(array(
                            'valid' => false,
                            'suceesUrl' => '',
                            'orderId' => '',
                            'errormsg' => $error_msg,
                        ));
                    }
                    $fundwalletdate = Model\CryptoWallet::where('created_at', '>=', date('Y-m-d').' 00:00:00')->orderBy('id','DESC')->first();
                    $uniqu_no = 1;
                    if($fundwalletdate != null && !empty($fundwalletdate) ){
                        $uniqu_no = (!empty($fundwalletdate->unique_no)) ? $fundwalletdate->unique_no + 1 : 1;
                    }
                    $fundwalletCertificate = Model\CryptoWallet::where('status',1)->orderBy('id','DESC')->first();
                    if($fundwalletCertificate != null && !empty($fundwalletCertificate) ){
                        $certificateId = (!empty($fundwalletCertificate->certificate_id)) ? $fundwalletCertificate->certificate_id : '' ;
                    }
                    if($request->payment_method == 'online'){
                        $bank = Model\Bank::where('code',$request->bank_id)->first();
                        $transfer =[];

                        // $transfer['bank_code'] = (Auth::user()->country_id == '45') ? 'YUN' : $request->currency;
                        $transfer['bank_id'] =  (Auth::user()->country_id == '45') ? '' : $request->bank_id;
                        $transfer['amount'] =   $request->bank_amount;
                        $transfer['order_id'] =  uniqid();
                        $transfer['name'] =   $usercheck->name;
                        $transfer['email'] =   $usercheck->email;
                        $transfer['address'] =   $usercheck->address;
                        $transfer['phone_number'] =   $usercheck->phone_number;
                        $transfer['bank_code'] =  ($bank) ? $bank->currency : 'RMB';

                        Model\OnlinePayment::where(['user_id'=>$usercheck->id,'status'=>'0'])->update(['status'=>'2']);
                        $model =  new Model\OnlinePayment();
                        $model->order_id = $transfer['order_id'];
                        $model->user_id = $usercheck->id;
                        $model->usd_amount = $request->amount;
                        $model->deposite_amount = $request->bank_amount;
                        $model->payment_date = date('Y-m-d'); 
                        $model->time = time();
                        $model->save();
                        if(Auth::user()->country_id == '45'){
                            $transfer['acc_name'] = $request->account_name;
                            // $transfer['acc_no'] = $request->account_no;
                            // $transfer['bank_code'] = (string)$bank->code;
                            
                            // $data['platform_id'] = env('C_RICHARD_PID');
                            // $data['service_id'] = env('C_RICHARD_SID');
                            // $data['payment_cl_id'] =uniqid();
                            // $data['amount'] = round($request->bank_amount);
                            // $data['bank_id'] = $request->bank_id;
                            // $data['name'] = $request->account_name;
                            // $data['last_number'] = $last_number = substr($request->account_no, -6);
                            
                            $model->usd_amount = (int)$request->amount;
                            $model->save();
                            $requestResponse = PaymentHelper::proceedPaymentChinaRichards($transfer); 
                            
                            if($requestResponse == null || $requestResponse['retcode']=='0'){//Luies Pay China
                            // if(isset($requestResponse['error_code']) && $requestResponse['error_code'] == 0000){
                                //China Richards
                                $fundWallet = new FundWallet;
                                $fundWallet->user_id = $model->user_id;
                                $fundWallet->amount = $model->usd_amount;
                                $fundWallet->usd_amount = $model->deposite_amount;
                                $fundWallet->type = 4; //Online Payment
                                $fundWallet->status = 0;
                                $fundWallet->action_date = Carbon::now();
                                // return redirect()->route('fundswallet')->with('success',trans('custom.procced_transaction'));
                                $orderId = $model->order_id;
                                $suceesUrl = route('crypto_wallets');
                                if($requestResponse != null){

                                    $fundWallet->payment_response = json_encode($requestResponse);
                                    $suceesUrl = "https://cashwork.smartmspay.com/mspay/mspayReturn.jsp?payeeName=".$requestResponse['payeeName']."&payeeBankCode=".$requestResponse['payeeBankCode']."&payeeBankName=".$requestResponse['payeeBankName']."&branchName=".$requestResponse['branchName']."&rockTradeNo=".$requestResponse['rockTradeNo']."&tradeNo=".$requestResponse['tradeNo']."&amount=".$requestResponse['amount']."&postScript=";
                                }
                                $fundWallet->save();
                                Session::flash('success',trans('custom.response_transaction'));

                                return json_encode(array(
                                    'valid' => true,
                                    'suceesUrl' => $suceesUrl,
                                    'orderId' => $orderId
                                ));

                            }else{
                                $errorcode = $requestResponse['retcode']; 
                                $error_msg = $requestResponse['retmsg'];
                                Session::flash('error',$error_msg);   

                                return json_encode(array(
                                    'valid' => false,
                                    'suceesUrl' => '',
                                    'orderId' => '',
                                    'errormsg' => $error_msg,
                                ));

                                // Session::flash('error',trans('custom.error_china_payment_'.$requestResponse['retcode']));
                                // return redirect()->back()->withInput($request->input());
                            }
                        }else if(Auth::user()->country_id == '131' && $request->payment_gateway == 'secureautopay'){
                            $transfer['acc_name'] = $request->account_name;
                            $transfer['acc_no'] = $request->account_no;
                            $transfer['bank_code'] = $bank->name;
                            $model->usd_amount = (int)$request->amount;
                            $model->save();
                            $requestResponse = PaymentHelper::proceedPaymentMalasia($transfer);
                            // print_r($requestResponse);die(); 
                            if($requestResponse == null || $requestResponse['status']=='success'){
                                FundWallet::where('user_id',$this->user->id)->where(['type'=>'4','status'=>"0"])->delete();
                                $fundWallet = new FundWallet;
                                $fundWallet->user_id = $model->user_id;
                                $fundWallet->amount = $model->usd_amount;
                                $fundWallet->usd_amount = $model->usd_amount;
                                $fundWallet->type = 4; //Online Payment
                                $fundWallet->status = 0;
                                $fundWallet->action_date = Carbon::now();
                                $fundWallet->save();
                                return redirect($requestResponse['payment_url']);
                                // return redirect()->route('crypto_wallets')->with('success',trans('custom.procced_transaction'));

                            }else{
                            // dd($requestResponse);
                                Session::flash('error',$requestResponse['message']);
                                return redirect()->back()->withInput($request->input());
                            }
                        }else{
                            $requestResponse = PaymentHelper::proceedPayment($transfer); 

                            // print_r($requestResponse);die();
                            if($requestResponse != null && $requestResponse['errCode']=='0' && $requestResponse['next_action']=='redirect' && $requestResponse['next_action']=='redirect'){
                                FundWallet::where('user_id',$this->user->id)->where(['type'=>'4','status'=>"0"])->delete();
                                $fundWallet = new FundWallet;
                                $fundWallet->user_id = $model->user_id;
                                $fundWallet->amount = $model->usd_amount;
                                $fundWallet->usd_amount = $model->usd_amount;
                                $fundWallet->type = 4; //Online Payment
                                $fundWallet->status = 0;
                                $fundWallet->action_date = Carbon::now();
                                $fundWallet->save();
                                return redirect($requestResponse['redirect_url']);
                            }else{
                                // echo $requestResponse['error'];die();
                                Session::flash('error','Something went wrong');

                                if(isset($requestResponse['error'])){
                                    Session::flash('error',$requestResponse['error']);
                                }
                                return redirect()->route('crypto_wallets')->withInput($request->input());
                            }
                        }
                        Session::flash('error','Something went wrong');
                        return redirect()->route('fundswallet')->withInput($request->input());
                        
                    }

                        // echo $request->payment_method; die();
                    if($request->payment_method == 'usdt'){
                        /*$this->validate($request, [
                            'upload_proof' => 'required:|mimes:jpg,jpeg,png,JPG,JPEG,pdf|max:12000',

                        ]);*/

                        $fundWallet = new Model\CryptoWallet;
                        $fundWallet->user_id = $this->user->id;
                        $fundWallet->amount = $request->amount;
                        $fundWallet->type = '0';
                        $fundWallet->status = 0;
                        $fundWallet->action_date = Carbon::now();
                        if ($request->hasFile('upload_proof') && $request->payment_method == 'usdt') {
                            $file = $request->file('upload_proof');
                            
                            $image = $request->file('upload_proof');
                            $filename=time() .'.'. $image->getClientOriginalExtension();        
                            // $image->storeAs('upload_bank_proof',$filename);
                            $image->move(public_path('uploads/upload_bank_proof'), $filename);
                            
                            $fundWallet->trans_slip = $filename;
                        }
                        $fundWallet->unique_no = $uniqu_no;
                        $fundWallet->save();
                    }               

                    Session::flash('success',trans('custom.payment_request_submited_review')); 
                }else{
                //     $isError = 1;
                 if( Auth::user()->country_id == '45'){
                    $error_msg = trans('custom.security_password_wrong');

                    return json_encode(array(
                        'valid' => false,
                        'suceesUrl' => '',
                        'orderId' => '',
                        'errormsg' => $error_msg,
                    ));
                }
                Session::flash('error',trans('custom.security_password_wrong'));   
            }
        }else{
            $isError = 1;
            Session::flash('error',trans('custom.session_has_been_expired_try_agian'));   
        }
        if($isError == 1 ){
            return redirect()->route('crypto_wallets')->withInput($request->input());
        }
        return redirect()->route('crypto_wallets');
    }
    public function yieldWallet(Request $request){

        $wallet = Model\UserWallet::where('user_id',auth()->id())->first();

        $history = Model\YieldWalletHistory::where('user_id',auth()->id())->where('amount','>',0);

        if($request->ajax()){
            
            $history = $history->orderby('id','desc')->paginate(10);
            return view('yield_wallet.partials.history',compact('wallet','history'));
        }

        $history = $history->orderby('id','desc')->paginate(10);
        return view('yield_wallet.index',compact('wallet','history'));
    }
    public function yieldWalletStore(Request $request){
         $request->validate([
             'amount'=>"required",
             'fund_type'=>"required",
             'security_password'=>"required",
         ]);
        $usercheck = Model\User::with('userwallet')->where('id',auth()->id())->where('status','active')->first();
         $isError = 0;
         if($usercheck != null){            
            if(Hash::check($request->security_password, $usercheck->secure_password)){
                 if(isset($request->amount) && $request->amount > $usercheck->userwallet['yield_wallet']){
                     Session::flash('error',trans('custom.transfer_amount_less_equal_wallet'));
                     return redirect()->back()->withInput($request->input());
                 }

                 $description = "";
                 if($request->fund_type == '0'){
                     $description = 'Transferred to Crypto Wallet';
                 }elseif($request->fund_type == '1'){
                     $description = 'Transferred to Withdrawal Wallet';                    
                 }else{
                    $description = 'Transferred to NFT Wallet';    
                 }
                 $yieldwalle = new Model\YieldWalletHistory();
                 $yieldwalle->user_id = auth()->id();
                 $yieldwalle->amount = $request->amount;
                 $yieldwalle->final_amount = $usercheck->userwallet['yield_wallet'] - $request->amount;
                 $yieldwalle->description = $description;
                 $yieldwalle->type = '0';
                 $yieldwalle->save();

                 if($request->fund_type=='0'){
                     $cryptoWalletHistory = new Model\CryptoWalletHistory;
                     $cryptoWalletHistory->user_id = auth()->id();
                     $cryptoWalletHistory->amount = $request->amount;
                     $cryptoWalletHistory->final_amount = $usercheck->userwallet['crypto_wallet'] + $request->amount;
                     $cryptoWalletHistory->description = 'Transferred from Yield Wallet';
                     $cryptoWalletHistory->type = '1';
                     $cryptoWalletHistory->save();
                     Model\UserWallet::where('user_id',$usercheck->id)->increment('crypto_wallet',round($request->amount,2));
                 }
                 if($request->fund_type=='1'){
                     $withdrawal = new Model\WithdrawalWalletHistory;
                     $withdrawal->user_id = auth()->id();
                     $withdrawal->amount = $request->amount;
                     $withdrawal->description = 'Transferred from Yield Wallet';
                     $withdrawal->type = '1';
                     $withdrawal->save();
                     Model\UserWallet::where('user_id',$usercheck->id)->increment('withdrawal_balance',round($request->amount,2));
                 }
                 if($request->fund_type=='2'){
                     $withdrawal = new Model\NftWalletHistory;
                     $withdrawal->user_id = auth()->id();
                     $withdrawal->amount = $request->amount;
                     $withdrawal->final_amount = $usercheck->userwallet['nft_wallet'] + $request->amount;
                     $withdrawal->description = 'Transferred from Yield Wallet';
                     $withdrawal->type = '1';
                     $withdrawal->save();
                     Model\UserWallet::where('user_id',$usercheck->id)->increment('nft_wallet',round($request->amount,2));
                 }
                 Model\UserWallet::where('user_id',$usercheck->id)->decrement('yield_wallet',round($request->amount,2));
                 if($request->fund_type=='0'){
                     Session::flash('success',trans('custom.requested_amount_transfered_crypto'));
                 }elseif($request->fund_type=='1'){
                     Session::flash('success',trans('custom.requested_amount_transfered_withdrawal'));
                 }else{
                     Session::flash('success',trans('custom.requested_amount_transfered_nft'));
                 }
                 return redirect()->route('yield_wallet');
             }else{
                 Session::flash('error',trans('custom.security_password_wrong'));   
                 return redirect()->back()->withInput($request->input());
             }
         }
    }
}
