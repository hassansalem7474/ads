<?php

namespace App\Console\Commands;

use App\Jobs\SendMail;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send daily mail';

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
        $ads = Ad::with('advertiser')->where('start_date',Carbon::tomorrow())->get();
        
        $emails = [];
        
        foreach($ads as $ad){
            array_push($emails,$ad->advertiser->email);
        }
        SendMail::dispatch($emails);
    }
}