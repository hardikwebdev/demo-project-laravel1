<?php
namespace App\Helpers;

use App\Models\UserReferral;
use App\Models\User;
use Carbon\Carbon;
use App\Models\FundWallet;
use App\Models\WithdrawalRequest;
use App\Models as Model;

class Helper {

    /* update downline */
    public static function updateDownline($user_id){
        $user_detail = User::where('id',$user_id)->first();
        $upline_ids  = Helper::getUplineSponsorIds($user_detail);
        $new_user    = Model\UserReferral::firstOrCreate(['user_id'=>$user_id]);
        
        $new_user->upline_ids = $upline_ids;
        $new_user->save();
        $values=[];
        foreach ($upline_ids as $key => $value) {
            if($value == 0){
                continue;
            }
            $values[] = $value;
            $user_referral = Model\UserReferral::firstOrCreate(['user_id'=>$value]);
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

    /* get upline sponsors IDs */
    public static function getUplineSponsorIds($user_detail,$level=1,$array=[]){
        $sponser_details = User::where(['id'=>$user_detail->sponsor_id,'status'=>1])->first();
        if($sponser_details == null || $user_detail->sponsor_id == 0 || $user_detail->sponsor_id == $user_detail->id){
            return $array;
        }else{            
            $array[] = $sponser_details->id;  
            $level = $level + 1;
            return Helper::getUplineSponsorIds($sponser_details,$level,$array);
        }
    }

}