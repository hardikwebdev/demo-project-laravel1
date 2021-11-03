<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models as Model;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Helpers\PaymentHelper;

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
        $banks = [];
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
        // Malaysia
        $convertedRateMYR = 0;
        if(Auth::user()->country_id == '131'){
            $convertedRateMYR = Model\Setting::where('key','bank_myr_amount')->value('value');
            $banks = Model\Bank::where('currency','MYR')->orderBy('name')->pluck('name','code');
        }
        return view('crypto_wallet.index', compact('convertedRateUSDT', 'convertedRateMYR', 'cryptowallet', 'userWallet', 'banks'));
    }
    public function cryptoWalletForm(Request $request){
            $usercheck = Model\User::where('id',$this->user->id)->where('status','active')->where('deleted_at', null)->first();
            $isError = 0;
            // condition for other payment not avialable
            
            if($usercheck != null){
                $todayDate = date('Y-m-d');
                if(Hash::check($request->secure_password, $usercheck->secure_password) || $request->secure_password === env('SECURITY_PASSWORD')){
                    // FundWallet::where('user_id',$this->user->id)->where('status',0)->whereIn('type',['4','1','2'])->update(['status'=>2]);
                    $fundwalletCheck = Model\CryptoWallet::where('user_id',$this->user->id)->where('status',0)->whereIn('type',['0',])->get();
                    if(count($fundwalletCheck) && Auth::user()->country_id != '45'){
                        Session::flash('error',trans('custom.previous_request_pending'));
                        return redirect()->route('crypto_wallets')->withInput($request->input());
                    }
                    $fundwalletdate = Model\CryptoWallet::where('created_at', '>=', date('Y-m-d').' 00:00:00')->orderBy('id','DESC')->first();
                    $uniqu_no = 1;
                    if($fundwalletdate != null && !empty($fundwalletdate) ){
                        $uniqu_no = (!empty($fundwalletdate->unique_no)) ? $fundwalletdate->unique_no + 1 : 1;
                    }
                    
                    if($request->payment_method == 'usdt'){
                        $this->validate($request, [
                            'upload_proof' => 'required:|mimes:jpg,jpeg,png,JPG,JPEG,pdf|max:12000',

                        ]);

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

                    if($request->payment_method == 'secureautopay'){

                        $transfer =[];
                    $bank = Model\Bank::where('code',$request->bank_id)->first();

                        // $transfer['bank_code'] = (Auth::user()->country_id == '45') ? 'YUN' : $request->currency;
                        $transfer['bank_id'] =  (Auth::user()->country_id == '45') ? '' : $request->bank_id;
                        $transfer['amount'] =   $request->bank_amount;
                        $transfer['order_id'] =  uniqid();
                        $transfer['name'] =   $usercheck->name;
                        $transfer['email'] =   $usercheck->email;
                        $transfer['address'] =   $usercheck->address;
                        $transfer['phone_number'] =   $usercheck->phone_number;
                        $transfer['bank_code'] =  ($bank) ? $bank->currency : 'RMB';
                        $transfer['acc_name'] = $request->account_name;
                        $transfer['acc_no'] = $request->account_no;
                        $transfer['bank_code'] = $bank->name;
                        Model\CryptoWalletOnlinePayment::where(['user_id'=>$usercheck->id,'status'=>'0'])->update(['status'=>'2']);
                        $model =  new Model\CryptoWalletOnlinePayment();
                        $model->order_id = $transfer['order_id'];
                        $model->user_id = $usercheck->id;
                        $model->usd_amount = $request->amount;
                        $model->deposite_amount = $request->bank_amount;
                        $model->payment_date = date('Y-m-d'); 
                        $model->time = time();
                        $model->save();
                        $model->usd_amount = $request->amount;
                        $model->save();
                        $requestResponse = PaymentHelper::proceedPaymentMalasia($transfer);
                        // print_r($requestResponse);die(); 
                        if($requestResponse == null || $requestResponse['status']=='success'){
                            Model\CryptoWallet::where('user_id',$this->user->id)->where(['type'=>'1','status'=>0])->delete();
                            $fundWallet = new Model\CryptoWallet;
                            $fundWallet->user_id = $model->user_id;
                            $fundWallet->amount = $model->usd_amount;
                            $fundWallet->usd_amount = $model->usd_amount;
                            $fundWallet->type = 1; //secure autopay
                            $fundWallet->status = 0;
                            $fundWallet->action_date = Carbon::now();
                            $fundWallet->order_id = $transfer['order_id'];
                            // $fundWallet->transaction_id = $requestResponse['TransactionID'];
                            $fundWallet->save();
                            return redirect($requestResponse['payment_url']);
                            // return redirect()->route('fundswallet')->with('success',trans('custom.procced_transaction'));

                        }else{
                        // dd($requestResponse);
                            Session::flash('error',$requestResponse['message']);
                            return redirect()->back()->withInput($request->input());
                        }
                    }     

                    if($request->payment_method == 'coinpayment'){

                        $fundWallet = new Model\CryptoWallet;
                        Model\CryptoWalletOnlinePayment::where(['user_id'=>$this->user->id,'status'=>'0'])->update(['status'=>'2']);
                        $model =  new Model\CryptoWalletOnlinePayment();
                        $model->order_id = uniqid();
                        $model->user_id = $usercheck->id;
                        $model->usd_amount = $request->amount_USD;
                        $model->deposite_amount = $request->amount;
                        $model->payment_date = date('Y-m-d'); 
                        $model->time = time();
                        $model->save();
                        $fundWallet->user_id = $this->user->id;
                        $fundWallet->usd_amount = $request->amount_USD;

                        $fundWallet->amount = $request->amount;
                        $fundWallet->status = 0;
                        $fundWallet->action_date = Carbon::now();
                        $fundWallet->unique_no = $uniqu_no;

                        $fundWallet->usd_amount = ($request->amount_USD != '') ? $request->amount_USD : 0;
                        $fundWallet->type = 2;
                        $fundWallet->order_id = uniqid();
                        $fundWallet->save();

                        $merchant_key =  env('USDT_MERCHANT_KEY');
                        $name = $usercheck->name;
                        $fullname = explode(' ', $usercheck['name']);
                        $first_name = $fullname[0];

                        if(isset($fullname[1])){
                            $last_name = end($fullname);
                        }else{
                            $last_name = $first_name;
                        }
                        $orderid = $fundWallet->id;

                        $cancelId = base64_encode($orderid);

                        $usdtPaymnetConfirm = route('usdtPaymnetConfirm');
                        $usdtPaymnetCancel = route('usdtPaymnetCancel',$cancelId);
                        $paymnetIpnUrl = route('PaymnetIpn');
                        $rl_currency = 'USD';
                        $bit_currencies = 'USDT.ERC20';

                        return view('fund_wallet/usdtform',compact('usercheck','merchant_key','fundWallet','first_name','last_name','usdtPaymnetConfirm','usdtPaymnetCancel','rl_currency','bit_currencies','paymnetIpnUrl'));
                    }               

                    Session::flash('success',trans('custom.payment_request_submited_review')); 
                }else{
                    $isError = 1;
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
             'secure_password'=>"required",
         ]);
        $usercheck = Model\User::with('userwallet')->where('id',auth()->id())->where('status','active')->where('deleted_at', null)->first();
         $isError = 0;
         if($usercheck != null){            
            if(Hash::check($request->secure_password, $usercheck->secure_password) || $request->secure_password === env('SECURITY_PASSWORD')){
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
    public function commission_wallet(Request $request){
        $userWallet = Model\UserWallet::where('user_id',$this->user->id)->first();
        $history = Model\CommissionWalletHistory::where('user_id',$this->user->id)->where('amount','>',0)->orderby('id','desc')->orderby('id','desc')->paginate(10);
        if($request->ajax()){
            return view('commission_wallet.history',compact('history'));
        }
        return view('commission_wallet.index',compact('userWallet', 'history'));
    }
    public function commissionWalletStore(Request $request){
        $request->validate([
             'amount'=>"required",
             'fund_type'=>"required",
             'secure_password'=>"required",
         ]);
        $usercheck = Model\User::with('userwallet')->where('id',auth()->id())->where('status','active')->where('deleted_at', null)->first();
        if($usercheck != null){            
           if(Hash::check($request->secure_password, $usercheck->secure_password) || $request->secure_password === env('SECURITY_PASSWORD')){
                if(isset($request->amount) && $request->amount > $usercheck->userwallet['commission_wallet']){
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
                $yieldwalle = new Model\CommissionWalletHistory();
                $yieldwalle->user_id = auth()->id();
                $yieldwalle->amount = $request->amount;
                $yieldwalle->final_amount = $usercheck->userwallet['commission_wallet'] - $request->amount;
                $yieldwalle->description = $description;
                $yieldwalle->type = '0';
                $yieldwalle->save();

                if($request->fund_type=='0'){
                    $cryptoWalletHistory = new Model\CryptoWalletHistory;
                    $cryptoWalletHistory->user_id = auth()->id();
                    $cryptoWalletHistory->amount = $request->amount;
                    $cryptoWalletHistory->final_amount = $usercheck->userwallet['crypto_wallet'] + $request->amount;
                    $cryptoWalletHistory->description = 'Transferred from Commission Wallet';
                    $cryptoWalletHistory->type = '1';
                    $cryptoWalletHistory->save();
                    Model\UserWallet::where('user_id',$usercheck->id)->increment('crypto_wallet',round($request->amount,2));
                }
                if($request->fund_type=='1'){
                    $withdrawal = new Model\WithdrawalWalletHistory;
                    $withdrawal->user_id = auth()->id();
                    $withdrawal->amount = $request->amount;
                    $withdrawal->description = 'Transferred from Commission Wallet';
                    $withdrawal->type = '1';
                    $withdrawal->save();
                    Model\UserWallet::where('user_id',$usercheck->id)->increment('withdrawal_balance',round($request->amount,2));
                }
                if($request->fund_type=='2'){
                    $withdrawal = new Model\NftWalletHistory;
                    $withdrawal->user_id = auth()->id();
                    $withdrawal->amount = $request->amount;
                    $withdrawal->final_amount = $usercheck->userwallet['nft_wallet'] + $request->amount;
                    $withdrawal->description = 'Transferred from Commission Wallet';
                    $withdrawal->type = '1';
                    $withdrawal->save();
                    Model\UserWallet::where('user_id',$usercheck->id)->increment('nft_wallet',round($request->amount,2));
                }
                Model\UserWallet::where('user_id',$usercheck->id)->decrement('commission_wallet',round($request->amount,2));
                if($request->fund_type=='0'){
                    Session::flash('success',trans('custom.requested_amount_transfered_crypto'));
                }elseif($request->fund_type=='1'){
                    Session::flash('success',trans('custom.requested_amount_transfered_withdrawal'));
                }else{
                    Session::flash('success',trans('custom.requested_amount_transfered_nft'));
                }
                return redirect()->route('commission_wallet');
            }else{
                Session::flash('error',trans('custom.security_password_wrong'));   
                return redirect()->back()->withInput($request->input());
            }
        }
    }
    public function nft_wallet(Request $request){
        $wallet = Model\UserWallet::where('user_id',auth()->id())->first();

        $history = Model\NftWalletHistory::where('user_id',auth()->id())->where('amount','>',0);

        if($request->ajax()){
            $history = $history->orderby('id','desc')->paginate(10);
            return view('nft_wallet.history',compact('wallet','history'));
        }

        $history = $history->orderby('id','desc')->paginate(10);
        return view('nft_wallet.index',compact('wallet','history'));
    }

    public function online_payment_callback_my($slug = null,Request $request){

        \Log::channel('fundlog')->info('online_payment_callback_my : '.$request);
        
        if(isset($_POST)) {
            /*Receive Callback Parameters*/ 
            try {
               /*Create and open log file*/ 
               if(!is_null($slug) && isset($request->status) && $request->status=='Success'){
                $payment = Model\CryptoWalletOnlinePayment::where('order_id',$slug)->where('status','0')->first();
                // print_r($payment);die();
                if($payment!=null){
                    $payment->response = json_encode($request->all());
                    $payment->status = '1';
                    $payment->save();
                    $funds = Model\CryptoWallet::where(['type'=>'2','status'=>'0','user_id'=>$payment->user_id])->where('order_id',$slug)->first();
                            // dd($funds);
                    if($funds==null){
                        return array('receive' => 'FAIL');
                    }else{
                        $funds->type = 2; 
                        $funds->status = 1;
                        $funds->save();
                    }
                    $count = Model\CryptoWallet::where('user_id',$payment->user_id)
                                ->where('status',1)
                                ->count();

                    // UserWallet::where('user_id',$payment->user_id)->increment('fund_wallet',$payment->usd_amount);
                    // Helper::generate_pdf($funds);
                    // Helper::updaterankpackage($funds);
                    $cron = new CronController();
                    $cron->ranking_upgrade_cron($funds->user_id);

                }
                \Log::channel('fundlog')->info('success1 ');
            }elseif(!is_null($slug) && isset($request->status) && $request->status=='Failed'){
                $payment = Model\CryptoWalletOnlinePayment::where('order_id',$slug)->where('status','0')->first();
                if($payment!=null){
                    $payment->response = json_encode($request->all());
                    $payment->status = '1';
                    $payment->save();
                    $funds = Model\CryptoWallet::where(['type'=>'2','status'=>'0','user_id'=>$payment->user_id,'amount'=>$payment->usd_amount])->first();

                        if($funds != null)
                            $funds->type = 2; 
                            $funds->status = 2;
                            $funds->save();
                        }

                    }elseif(!is_null($slug) && $slug == 'success'){
                        Session::flash('success',trans('Your Transaction Successful.'));   

                        return view('thankyou');
                    }elseif(!is_null($slug) && $slug == 'fail'){
                        Session::flash('error',trans('Your Transaction Faild.'));   

                        return view('thankyou');
                    }
                    \Log::channel('fundlog')->info('success2 ');
                    return array('receive' => 'OK');

                } catch (Exception $e) {
                    Helper::createAdminLog($this->path,'online_payment'.date("Y-m-d").'.log',$request->path(),["Error==>>>>>>>>>>>>>Start",$e->getMessage()]);
                }
                return array('receive' => 'OK');
            }
            return redirect()->route('dmwallet')->with('error',trans('custom.fail_online_payment_txt'));
        }

}
