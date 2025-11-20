<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\AdvertisementEndMail;
use App\models\backend\Advertisement;
use Mail;
use Carbon\Carbon;
class AdvertisementEndCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:ads-end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Advertisement ended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Advertisement::whereDate('end_date', '=', Carbon::now())->get();
        
        foreach ($users as $user) {
            $mailData = [
                "name" =>$user->name,
                "email" =>$user->email,
                "start_date" => $user->start_date,
                "end_date" => $user->end_date
            ];
            Mail::to($user->email)->queue(new AdvertisementEndMail($mailData));
        } 
        $this->info('Advertisement end emails sent successfully.');
    }
}
