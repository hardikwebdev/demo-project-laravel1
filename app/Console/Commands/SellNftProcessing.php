<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\NftSellHistory;
use Illuminate\Console\Command;

class SellNftProcessing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nftsell:processing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nft on sale request change status to processing';

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
        $date = Carbon::today()->subDays(3)->format('Y-m-d');
        $changestatus = NftSellHistory::where('status','2')->whereNotNull('approve_date')->whereDate('approve_date','=',$date)->get();
        
        foreach ($changestatus as $change) {
            $change->status = 5;
            $change->approve_for_processing_date = Carbon::now();
            $change->save();
        }
        $this->info('Successfully change status');
        // return Command::SUCCESS;
    }
}
