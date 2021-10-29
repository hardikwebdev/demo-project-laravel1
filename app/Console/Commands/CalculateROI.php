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

            $stackingpools = StackingPool::where('status',1)->get();
            foreach($stackingpools as $stackingpool){
                $stacking_pool_package = $stackingpool->stacking_pool_package;
            }
        });
        return Command::SUCCESS;
    }
}
