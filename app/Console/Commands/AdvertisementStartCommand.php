<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\backend\Advertisement;
use Carbon\Carbon;
use App\Mail\AdvertisementStartMail;
use Mail;

class AdvertisementStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:ads-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advertisement Started';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Advertisement::whereDate('start_date', '=', Carbon::now())->get();
        foreach ($users as $user) {
            $adsReminderMailData = [
                "email" =>$user->email,
                "start_date" => $user->start_date,
                "end_date" => $user->end_date
            ];
            Mail::to($user->email)->queue(new AdvertisementStartMail($adsReminderMailData));
        } 
        $this->info('Advertisement start emails sent successfully.');
        
    }
}
