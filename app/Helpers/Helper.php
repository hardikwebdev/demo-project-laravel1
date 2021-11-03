<?php
namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\FundWallet;
use App\Models\CryptoWallet;
use App\Models\UserReferral;
use App\Models\SupportTicket;
use App\Models\WithdrawalRequest;
use App\Models as Model;
use App\Models\StackingPool;
use App\Models\NftWallet;
use App\Models\NftPurchaseHistory;


class Helper {
    
    /* update downline */
    public static function updateDownline($user_id){

        $user_detail = User::where('id',$user_id)->first();
        $upline_ids  = Helper::getUplineSponsorIds($user_detail);
        $new_user    = UserReferral::firstOrCreate(['user_id'=>$user_id]);
        $new_user->upline_ids = $upline_ids;
        $new_user->save();
        $values=[];
        
        foreach ($upline_ids as $key => $value) {
            if($value == 0){
                continue;
            }
            $values[] = $value;
            $user_referral = UserReferral::firstOrCreate(['user_id'=>$value]);
            if($user_referral->downline_ids==null){
                 $user_referral->downline_ids = [$user_id];
            }else{
                $allDownlineids =$user_referral->downline_ids!=null&&is_array($user_referral->downline_ids)&&count($user_referral->downline_ids)>0?$user_referral->downline_ids:[];
                array_push($allDownlineids,$user_id);
                $user_referral->downline_ids = $allDownlineids;
               
            }
          
            if($user_referral->direct_downline_ids==null){
                 $user_referral->direct_downline_ids = [$user_id];
            }else{
                $allDownlineids = $user_referral->direct_downline_ids!=null&&is_array($user_referral->direct_downline_ids)&&count($user_referral->direct_downline_ids)>0?$user_referral->direct_downline_ids:[];
                array_push($allDownlineids,$user_id);
                $user_referral->direct_downline_ids = $allDownlineids;
                
            }
            $user_referral->save();
        }
    }

    /* get upline sponsors */
    public static function getUplineSponsor($user_detail,$level=1,$array=[]){
        $sponser_details = User::where(['id'=>$user_detail->sponsor_id,'status'=>'active'])->first();
        if($sponser_details==null || $user_detail->sponsor_id ==0 ){
            return $array;
        }else{            
            $sponser_details->level = $level;
            $array[$level] = $sponser_details;  
            $level = $level + 1;
            return Helper::getUplineSponsor($sponser_details,$level,$array);
        }
    }

    /* get upline sponsors IDs */
    public static function getUplineSponsorIds($user_detail,$level=1,$array=[]){
        $sponser_details = User::where(['id'=>$user_detail->sponsor_id,'status'=>'active'])->first();
        if($sponser_details == null || $user_detail->sponsor_id == 0 || $user_detail->sponsor_id == $user_detail->id){
            return $array;
        }else{            
            $array[] = $sponser_details->id;  
            $level = $level + 1;
            return Helper::getUplineSponsorIds($sponser_details,$level,$array);
        }
    }

    /* Get Array of  All Downline users ids */
    public static function getAllDownlineIds($sponsor_id,$array=[]){

        $direct_downline = User::where(['status'=>"active",'sponsor_id'=>$sponsor_id])->pluck('id')->toArray();
        
        if(count($direct_downline) == 0 || (count($direct_downline) > 0 && $direct_downline[0] == $sponsor_id)){
            return $array;
        }else{
            if(!is_array($array)){
                $array = [];
            }
            $array = array_merge($array, $direct_downline);
            foreach ($direct_downline as $key => $value) {
                 $array = Helper::getAllDownlineIds($value,$array);
            }
        }
        return $array;
    }

    /* Get Array of  All Downline users ids left */
    public static function getAllDownlineIdsLeft($placement_id,$level,$array=[]){

        $direct_downline = User::where(['status'=>"active",'placement_id'=>$placement_id,'promo_account'=>'0']);
        if($level == 1){
            $direct_downline = $direct_downline->where('child_position','left');
        }
        $direct_downline = $direct_downline->pluck('id')->toArray();

        if(count($direct_downline) == 0 || (count($direct_downline) > 0 && $direct_downline[0] == $placement_id)){
            return $array;
        }else{
            $array = array_merge($array, $direct_downline);
            $level++;
            foreach ($direct_downline as $key => $value) {
                 $array = Helper::getAllDownlineIdsLeft($value,$level,$array);
            }
        }
        return $array;
       
    }


     /* Get Array of  All Downline users ids right */
    public static function getAllDownlineIdsRight($placement_id,$level,$array=[]){

        $direct_downline = User::where(['status'=>"active",'placement_id'=>$placement_id,'promo_account'=>'0']);
        if($level == 1){
            $direct_downline = $direct_downline->where('child_position','right');
        }
        $direct_downline = $direct_downline->pluck('id')->toArray();

        if(count($direct_downline) == 0 || (count($direct_downline) > 0 && $direct_downline[0] == $placement_id)){
            return $array;
        }else{
            $array = array_merge($array, $direct_downline);
            $level++;
            foreach ($direct_downline as $key => $value) {
                 $array = Helper::getAllDownlineIdsRight($value,$level,$array);
            }
        }
        return $array;
    }

    /* left group sale */
    public static function getTotalgroupsalesLeft($user){
        // print_r($user);die();
        try {
            $allDownlineids = Helper::getAllDownlineIdsLeft($user->id,1);
            $allDownlineids = $allDownlineids != null ? $allDownlineids : [];
            $totalgroupsales = StackingPool::whereIn('user_id',$allDownlineids)
                                    ->whereHas('user_detail',function($query){
                                        $query->where('status','active');
                                    })
                                    ->get()
                                    ->sum('amount');
            // if($totalgroupsales > 0){
            //     echo $totalgroupsales;die();
            // }
            return $totalgroupsales;
        }catch(\Illuminate\Exception\ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        } 
    }

    /* right group sale */
    public static function getTotalgroupsalesRight($user){
        try {
            $allDownlineids = Helper::getAllDownlineIdsRight($user->id,1);
            $allDownlineids = $allDownlineids!=null ? $allDownlineids : [];
            $totalgroupsales = StackingPool::whereIn('user_id',$allDownlineids)
                                    ->whereHas('user_detail',function($query){
                                        $query->where('status','active');
                                    })
                                    ->get()
                                    ->sum('amount');
            // $totalgroupsales = User::with('staking_history')
            //                         ->whereIn('id',$allDownlineids)
            //                         ->get()
            //                         ->sum('staking_history.amount');

            return $totalgroupsales;

        }catch(\Illuminate\Exception\ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        } 
    }

    /* left group sale */
    public static function getTotalgroupsalesTodayLeft($user){
        try {
            $allDownlineids = Helper::getAllDownlineIdsLeft($user->id,1);
            $allDownlineids = $allDownlineids != null ? $allDownlineids : [];
            $today = Carbon::today();
            $totalgroupsales = StackingPool::whereIn('user_id',$allDownlineids)
                                    ->whereHas('user_detail',function($query){
                                        $query->where('status','active');
                                    })
                                    ->whereDate('created_at',$today)
                                    ->get()
                                    ->sum('amount');

            return $totalgroupsales;
        }catch(\Illuminate\Exception\ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        } 
    }

    /* right group sale */
    public static function getTotalgroupsalesTodayRight($user){
        try {
            $allDownlineids = Helper::getAllDownlineIdsRight($user->id,1);
            $allDownlineids = $allDownlineids!=null ? $allDownlineids : [];
            $today = Carbon::today();
            $totalgroupsales = StackingPool::whereIn('user_id',$allDownlineids)
                                    ->whereHas('user_detail',function($query){
                                        $query->where('status','active');
                                    })
                                    ->whereDate('created_at',$today)
                                    ->get()
                                    ->sum('amount');

            return $totalgroupsales;

        }catch(\Illuminate\Exception\ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        } 
    }

    /* total group sale */
    public static function getTotalgroupsales($user){
        try {
            $allDownlineids = Helper::getAllDownlineIds($user->id);
            $allDownlineids = $allDownlineids!=null?$allDownlineids:[];
           
            $totalgroupsales = StackingPool::whereIn('user_id',$allDownlineids)
                                    ->whereHas('user_detail',function($query){
                                        $query->where('status','active');
                                    })
                                    ->get()
                                    ->sum('amount');

            return $totalgroupsales;
        }catch(\Illuminate\Exception\ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        } 
    }

    public static function getDirectTotalgroupsales($user){
        try {

            $allDirectDownlineids = Helper::getDirectDownlineIds($user->id);
            $allDirectDownlineids = $allDirectDownlineids!=null?$allDirectDownlineids:[];
            \DB::enableQueryLog();
            $totaldirectgroupsales = User::with('staking_history')->whereIn('id',$allDirectDownlineids)->where(['status'=>"active"])->get()->sum('staking_history.amount');
            return $totaldirectgroupsales;

        }catch(ErrorException $e){
            return 0;
        }catch (\Exception  $e) {
            return 0;
        }   
    }

     public static function getDirectDownlineIds($sponsor_id){
        
       $direct_downline = User::where(['status'=>"active",'sponsor_id'=>$sponsor_id])->where('id','!=',$sponsor_id)->pluck('id')->toArray();  
       
       return $direct_downline;     
    }


    public static function ic_number_verification($icnumber,$sponser_name){
        $sponser_details =  User::where('username',$sponser_name)->first();
        $count = User::where('identification_number',$icnumber)->where(['status'=>'active'])->where('id','!=',$sponser_details->id)->count();
        $exists = 0;
        if($count > 0){
            $downline_ids = $upline_ids = [];
            $user_ids=User::where('identification_number',$icnumber)->where(['status'=>'active'])->pluck('id');
            $user_reference = UserReferral::where('user_id',$sponser_details->id)->first();
            $downline_ids = $user_reference!=null?$user_reference->direct_downline_ids:[];
            $upline_ids = $user_reference!=null?$user_reference->upline_ids:[];
            $normal_count = 0;
            $downline_count = 0;
            $downline_count = 0;
            if(($downline_ids!=null && is_array($downline_ids)) || ($upline_ids!=null && is_array($upline_ids))) {
                foreach ($user_ids as $key => $value) {
                    if($downline_count>=3 ||  $normal_count >= 1){
                        $exists = 1;
                        break;
                    }
                    if(is_array($downline_ids) && in_array($value,$downline_ids)){
                        $downline_count++;
                    }else if(is_array($upline_ids) && in_array($value,$upline_ids)){
                        $downline_count++;
                    }else if($sponser_details->id == $value){
                        $downline_count++;
                    }else{
                        $normal_count++;
                    }
                }
                if($downline_count>=3 ||  $normal_count >=1){
                    $exists = 1;
                }
            }else{
                $exists = 0;
            }     
        }
        if($exists){
            return true;
        }else{
            return false;
        }

    }

    // count support unread support ticket
    public static function getUnreadCount(){
        return SupportTicket::where('is_read','0')->where('status','0')->count();
     }

      // count CryptoWallet usdt pending request
    public static function getPendingCryptoCreditRequestCount(){
        return CryptoWallet::where('type','0')->where('status','0')->count();
     }

    // count NftWallet usdt pending request
    public static function getPendingNftCreditRequestCount(){
        return NftWallet::where('type','0')->where('status','0')->count();
     }

      // count Nft Purchase Request
    public static function getPendingNftPurchaseRequestCount(){
        return NftPurchaseHistory::where('status','2')->count();
     }

       // count  withdrawal Request
    public static function getwithdrawalRequestCount(){
        return WithdrawalRequest::where('type','0')->where('status','0')->count();
     }
    public static function defixFinanceID($userId ,$date){
        $date = str_replace('-','',$date);
        $defixFinanceID = 'DEF'.$userId.$date;
        return $defixFinanceID;
    } 

}