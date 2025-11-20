<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterEmail;
use Illuminate\Http\Request;
use App\Models\frontend\Newsletter;
use Mail;
use App\Mail\NewsletterMail;
use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;
class NewsletterController extends Controller
{

    public function index(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }
        $newsletter_list = Newsletter::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $newsletter_list = $newsletter_list->where('email', 'LIKE', '%'.$_GET['search'].'%');
        }
        $newsletter_list = $newsletter_list->orderBy('id', 'desc')->paginate($qty);
        return view('backend.newsletter.index', compact('newsletter_list'));
    }

    public function store(Request $request){ 
        $validater = $request->validate([
            'email'=>'required|email|unique:newsletters',
        ]);  
        Newsletter::create([
            'email' => $request->email,
            'user_type' => 0
        ]);
        return redirect()->back()->with('newsletter_subscribed', "You have successfully subscribed");
    
    }

    public function updateSatus(Request $request){
        $newsletter_status = $request->newsletter_status;
        $newsletter_id = $request->newsletter_id; 
        $newsletter_status_update = Newsletter::where('id', $newsletter_id)->update(['status' => $newsletter_status]);
        return response()->json([
            'status' => 200,
            'message' => 'status_updated'
        ]);
    }

    public function create(){
        return view('backend.newsletter.create');
    }

    public function NewsletterSend(Request $request){
        $validation = $request->validate([
            'message' => 'required',
            'subject' => 'required',
            'attachment' => 'max:25000|mimes:doc,docx,pdf,png,jpg,jpeg'
        ]);

        // $title = $request->title;
        // $subject = $request->subject;
        $subscribers = Newsletter::get();
        $message = $request->message;
        $subject = $request->subject;


        if($request->hasFile('attachment')){
            $thumbnailFile = $request->file('attachment');
            $originalThumbnailName = $thumbnailFile->getClientOriginalName();
            $thumbnail_name = time().'.'.$thumbnailFile->extension();
            $thumbnailFile->move(public_path('upload/attachment'), $thumbnail_name);
            $m_c_thumbnail = $thumbnail_name;

             foreach($subscribers as $sub){ 
            $newsletterMailData = [
                // 'title' => $title,
                'subject' => $subject,
                'news_message' => $message,
                'email' => $sub->email,
                'attachment' => $m_c_thumbnail, 
            ];
            

            dispatch(new SendNewsletterEmail($newsletterMailData, $m_c_thumbnail));
            

            // Mail::send('email.newsletter', $newsletterMailData, function($message)use($newsletterMailData, $m_c_thumbnail) {
            //     $message->to($newsletterMailData["email"], $newsletterMailData["email"])
            //             ->subject($newsletterMailData["subject"])
            //             ->attachData(Storage::disk('custom')->get($m_c_thumbnail), $m_c_thumbnail);
            // });

            // Mail::to($sub->email)->send(new NewsletterMail($newsletterMailData));
        }
        }else{
            foreach($subscribers as $sub){ 
                $newsletterMailData = [
                    // 'title' => $title,
                    'subject' => $subject,
                    'news_message' => $message,
                    'email' => $sub->email, 
                ];
                dispatch(new SendNewsletterEmail($newsletterMailData, $m_c_thumbnail = ''));
                // Mail::send('email.newsletter', $newsletterMailData, function($message)use($newsletterMailData) {
                //     $message->to($newsletterMailData["email"], $newsletterMailData["email"])
                //             ->subject($newsletterMailData["subject"]);
                // });
                // Mail::to($sub->email)->send(new NewsletterMail($newsletterMailData));
            }
        }
        return redirect('admin/newsletter')->with('mail_sent', 'Newsletter mail sent successfully !');
    }

    public function destroy($id){
        $newsletter = Newsletter::findOrFail($id);
        $newsletter_delete = $newsletter->delete();

        if($newsletter_delete){
            return redirect()->back()->with('delete_success', 'Newsletter has been delete successfully !');
        }else{
            return redirect()->back()->with('delete_failed', 'Something went wrong please try again !');
        } 
    }
}
