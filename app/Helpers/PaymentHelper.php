<?php
namespace App\Helpers;

use App\User;
use App\PipsRebateHistory;
use App\OverridingWalletHistory;
use App\LeaderBonusWalletHistory;
use App\ProfitSharingWalletHistory;
use App\Model as Model;
use Carbon\Carbon;

class PaymentHelper{

	public static function genrateStringMalasia($input){

	    $data['customer_name'] = $input['name'];
	    $data['customer_email'] = $input['email'];
	    $data['transaction_amount'] = $input['amount'];
	    $data['bank_name'] = ($input['bank_code'] == 'Maybank') ? 'may_bank' : strtolower(str_replace(' ', '_',$input['bank_code']));
	    $data['return_url'] = route('crypto_wallets');
	    $data['ipn_url'] = route('online-payment-my-response',$input['order_id']);
	    $data['custom_transaction_id'] = $input['order_id'];
	        // $data['success_url'] = route('online-payment-my-response','success');
	        // $data['fail_url'] = route('online-payment-my-response','fail');
	    if(isset($input['app'])){
	        $data['app'] = true;
	        $data['return_url'] = 'https://portal.secureautopay.com/thankyou/fail?order_id='.$input['order_id'];

	    }
	        // $data['agent'] = '3Ad2Cg7YWVXLuYZK';
	    return json_encode($data);       
	}
	public static function proceedPaymentMalasia($input){   

	    $requestParams = PaymentHelper::genrateStringMalasia($input);
	        // print_r($input);die();
	    $url = env('MYR_Deposit_URL_Online');
	        // dd($url,$requestParams);

	    \Log::channel('fundlog')->debug('Error==>>>>>>>>>>>>>Proceed Payment Malasia Start.');
	    \Log::channel('fundlog')->info('Showing user profile for user: '.json_encode([$requestParams,$input]));
	    $headers    = [];
	    $headers['Content-Type']  = 'application/json';
	    $headers['client_id']  = env('MYR_client_id_Online');
	    $headers['client_secret']  = env('MYR_client_secret_Online');
	    $curl = curl_init();

	    curl_setopt_array($curl, array(
	      CURLOPT_URL => $url,
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => "",
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 30,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => "POST",
	      CURLOPT_POSTFIELDS => $requestParams,
	      CURLOPT_HTTPHEADER => array(
	            // "cache-control: no-cache",
	        "client_id: ".env('MYR_client_id_Online'),
	        "client_secret: ".env('MYR_client_secret_Online'),
	        "content-type: application/json",
	    ),
	  ));
	    $result = curl_exec($curl);
	    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
	    $error = curl_error($curl);

	    \Log::channel('fundlog')->debug(json_encode($result));
	    \Log::channel('fundlog')->debug('Error==>>>>>>>>>>>>>Proceed Payment Malasia END.');
	    return json_decode($result,true);
	}
}