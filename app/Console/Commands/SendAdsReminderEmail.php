<?php

namespace App\Console\Commands;

use App\Models\backend\Advertisement;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Mail;
use App\Mail\AdvertisementReminderMail;

class SendAdsReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send-ads-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users before 5 days to end advertisement time period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        $users = Advertisement::whereDate('end_date', '=', Carbon::now()->addDays(7)->toDateString())->get(); 
        foreach ($users as $user) {
            $adsReminderMailData = [
                "email" =>$user->email,
                "start_date" => $user->start_date,
                "end_date" => $user->end_date
            ];
            Mail::to($user->email)->queue(new AdvertisementReminderMail($adsReminderMailData));
        } 
        $this->info('Reminder emails sent successfully.');
    }
}
