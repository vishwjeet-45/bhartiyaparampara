<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Mail\ContactFormUserMail;

class ContactUsController extends Controller
{
    public function contactusEnquiry(Request $request){ 
        $validated =  $request->validate([
            'name' => 'required',
            'email_id' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'comment' => 'required',
            // 'captcha' => 'required|captcha'
        ]);

        $name = $request->name;
        $email = $request->email_id;
        $phone = $request->phone;
        $subject = $request->subject; 
        $comment = $request->comment;
        
        $mailFromAddress = Config::get('mail.from.address');
        $mailData = [
            "name" => $name,
            "email" => $email,
            "phone" => $phone, 
            "subject" => $subject, 
            "comment" => $comment
        ]; 

        $userMailData = [
            "name" => $name,
            "email" => $email,
            "phone" => $phone, 
            "subject" => $subject,
        ];
        try{
            Mail::to($mailFromAddress)->send(new ContactUsMail($mailData));
            Mail::to($email)->send(new ContactFormUserMail($userMailData));
        }catch(\Exception $e){ 
        return redirect()->back()->with('not_sent', $e->getMessage()); 
        }
        return redirect()->back()->with('sent', "Your enquiry has been submitted !");  
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }


}
