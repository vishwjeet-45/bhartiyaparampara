<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Mail;

class SendNewsletterEmail implements ShouldQueue
{
    protected $newsletterMailData;
    protected $m_c_thumbnail;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct($newsletterMailData, $m_c_thumbnail)
    {
        $this->newsletterMailData = $newsletterMailData;
        $this->m_c_thumbnail = $m_c_thumbnail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if($this->m_c_thumbnail == ''){
               Mail::send('email.newsletter', $this->newsletterMailData, function($message) {
                     $message->to($this->newsletterMailData["email"], $this->newsletterMailData["email"])
                             ->subject($this->newsletterMailData["subject"]);
                            });
        }else{
            Mail::send('email.newsletter', $this->newsletterMailData, function ($message) {
                $message->to($this->newsletterMailData["email"], $this->newsletterMailData["email"])
                        ->subject($this->newsletterMailData["subject"])
                        ->attachData(Storage::disk('custom')->get($this->m_c_thumbnail), $this->m_c_thumbnail);
            });
        }

    }
}
