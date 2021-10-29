<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StackingPool;

class CalculateROI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:monthlyROI {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate User ROI monthly.';

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
            $result_date = ($this->argument('date')) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->argument('date').' 00:00:00')->subDay()->format('Y-m-d') : Carbon::today()->subDay()->format('Y-m-d');


            
            $stakingpools = StackingPool::where('status',1)->get();
            foreach($stakingpools as $stakingpool){
                $staking_pool_package = $stakingpool->staking_pool_package;

                if($stakingpool->staking_period == 12){
                    // $staking_period = $staking_pool_package->
                }
            }
        });
        return Command::SUCCESS;
    }
}
