<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StackingPool;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\Package;
use App\Models\CommissionWalletHistory;
use App\Models\UserWallet;
use App\Models\ReferralCommission;

class CalculateReferralCommission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:directreferral {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate users direct referral commission';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(0);
        \DB::transaction(function () {
            // $result_date = ($this->argument('date')) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->argument('date').' 00:00:00')->subDay()->format('Y-m-d') : Carbon::today()->subDay()->format('Y-m-d');

            StackingPool::where('status',0)->update(['status' => 1]);
            $stakingpools = StackingPool::where('status',1)->get();
            foreach($stakingpools as $stakingpool){
                $user = $stakingpool->user_detail;
                $upline_users = Helper::getUplineSponsor($user);
                $last_comm_percent = 0;
                $sum_rank_percent = 0;
                $package_detail = Package::where('amount','<=',$stakingpool->amount)->orderBy('amount','desc')->first();
                if(!$package_detail){
                    continue;
                }
                foreach ($upline_users as $key => $value) {

                    $level_commission_percent = 0;
                    $total_commission = $package_detail->direct_refferal; //$value->package_detail->direct_refferal;
            
                    if($total_commission <= 0){
                        continue;
                    }
                    if($value->level == '1'){
                        $level_commission_percent = $package_detail->direct_refferal;
                    }else if($value->level!= '1'){

                        $level_commission_percent = $package_detail->direct_refferal - $sum_rank_percent;
                    }   
                    
                    
                    if($level_commission_percent <= 0) {
                        continue;
                    }
                    $sum_rank_percent = $sum_rank_percent + $level_commission_percent; 
                    $commission_percent = $level_commission_percent / 100;
                    $commission_amount = round($package_detail->amount * $commission_percent,2); 
                    $commission_wallet = UserWallet::where('user_id',$value->id)->first();

                    $history_data["type"] = "1";
                    $history_data["amount"] = $commission_amount;
                    $history_data["user_id"] = $value->id;
                    $history_data["from_user_id"] = $stakingpool->user_id;
                    $history_data["commission_type"] = 'referral';
                    $history_data["description"] = 'Referral commission from '.$stakingpool->user_detail->username;
                    $history_data["final_amount"] = $commission_wallet->commission_wallet + $commission_amount;

                    CommissionWalletHistory::create($history_data);
                    $commission_wallet->increment('commission_wallet',$commission_amount);

                    $data["status"] = 1;
                    $data["amount"] = $commission_amount;
                    $data["user_id"] = $value->id;
                    $data["from_user_id"] = $stakingpool->user_id;
                    $data["stacking_pool_id"] = $stakingpool->id;
                    $data["description"] = 'Referral commission from '.$stakingpool->user_detail->username;
                    $data["actual_percent"] = $level_commission_percent;
                    $data["percent"] = $package_detail->direct_refferal;

                    ReferralCommission::create($data);
                    $commission_wallet->increment('referral_commission',$commission_amount);


                }
            }
        });
        
        return Command::SUCCESS;
    }
}