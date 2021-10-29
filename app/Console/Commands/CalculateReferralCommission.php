<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StackingPool;

class CalculateReferralCommission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:directreferral {pool_id}';

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
        $pool_id = $this->argument('date');
        $stackingpool = StackingPool::find($pool_id);
        return Command::SUCCESS;
    }
}
