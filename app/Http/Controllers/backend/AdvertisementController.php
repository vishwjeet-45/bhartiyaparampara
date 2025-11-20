<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Advertisement;
use App\Mail\AdvertisementFormAdminMail;
use App\Mail\AdvertisementFormUserMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Email;
use App\Mail\AdvertisementStartMail; 

class AdvertisementController extends Controller
{
    public function index(){
        $current_date = Carbon::now()->format('Y-m-d');
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }

        $ads_list = Advertisement::select('*');
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $c_list = $ads_list->where('title', 'LIKE', '%'.$_GET['search'].'%');
        } 
        $ads_list = $ads_list->orderBy('id', 'desc')->paginate($qty);
        $ads_list->appends([
            'qty' => $qty,
            'search' => isset($_GET['search']) ? $_GET['search'] : '',
        ]);
        return view('backend.advertisement.index', compact('ads_list', 'current_date'));
    }

    public function store(Request $request){
        $current_date = Carbon::now()->format('Y-m-d');
        $originalName = $request->file('image')->getClientOriginalName(); //get full name of the file with extension
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
        $extension = $request->file('image')->getClientOriginalExtension();  //get the extension
        $fileName = 'advertisement_' . time() . '.' . $extension;  // creat new and unique name 
        $request->file('image')->move(public_path('build/assets/upload/advertisement'), $fileName); 
       $result =  Advertisement::create([
            "title" => $request->title,
            "image" => "public/build/assets/upload/advertisement/".$fileName,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "size" => $request->size,
            "position" => $request->position,
            "price" => $request->price, 
            "email" => $request->email,
            "target_url" => $request->target_url,
            "status" => 1
        ]);  
        // if($current_date == $request->start_date){
        // $mailData = [
        //     "email" => $request->email,
        //     "start_date" => $request->start_date,
        //     "end_date" => $request->end_date,
        //     "size" => $request->size,
        //     "position" => $request->position,
        // ];
        // Mail::to($request->email)->queue(new AdvertisementStartMail($mailData));
        // }
        $mailData = [
            "email" => $request->email,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "size" => $request->size,
            "position" => $request->position,
        ];
        Mail::to($request->email)->send(new AdvertisementStartMail($mailData));

        if($result){
            return redirect()->back()->with('added', "Record has been added !");
        }else{
            return redirect()->back()->with('not_added', "Something went wrong !");
        }
    }

    public function statusUpdate(Request $request){
        $id = $request->id;
        $status = $request->status;

        $result = Advertisement::where('id', $id)->update([
            "status" => $status
        ]);

        if($result){
            return response()->json([
                "status" => 200,
                "message" => "status_updated"
            ]);
        }else{
            return response()->json([
                "status" => 400,
                "message" => "failed"
            ]);
        }
    }

    public function edit(Request $request){
        $id = $request->id;
        $data = Advertisement::where('id', $id)->first();

        return response()->json([
            "data" => $data
        ]);
    }


    public function update(Request $request){
        $id = $request->edit_id; 
        if($request->hasFile('edit_image')){
            $originalName = $request->file('edit_image')->getClientOriginalName(); //get full name of the file with extension
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);   // get full name of the file without extension
            $extension = $request->file('edit_image')->getClientOriginalExtension();  //get the extension
            $fileName = 'advertisement_' . time() . '.' . $extension;  // creat new and unique name 
            $request->file('edit_image')->move(public_path('build/assets/upload/advertisement'), $fileName); 
           $file_result =  Advertisement::where('id', $id)->update(['image' => "public/build/assets/upload/advertisement/".$fileName,]);
        }
        $result =  Advertisement::where('id', $id)->update([
            "title" => $request->edit_title, 
            "start_date" => $request->edit_start_date,
            "end_date" => $request->edit_end_date,
            "size" => $request->edit_size,
            "position" => $request->edit_position,
            "price" => $request->edit_price, 
            "email" => $request->edit_email, 
            "target_url" => $request->target_url,
        ]);
        if($result || $file_result){
            return redirect()->back()->with('updated', "Record has been updated !");
        }else{
            return redirect()->back()->with('not_update', "Something went wrong !");
        }
    }

    public function destroy(Request $request){
        $id = $request->id;

        $data = Advertisement::findOrFail($id);
        $result = $data->delete();

        if($result){
            return redirect()->back()->with('deleted', "Record has been deleted !");
        }else{
            return redirect()->back()->with('not_deleted', "Something went wrong !");
        } 
    }



    public function advertisementEnquiry(Request $request){ 
        $validated =  $request->validate([
            'name' => 'required',
            'email_id' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'category' => 'required',
            'duration' => 'required',
            'size' => 'required',
            'position' => 'required',
            'comment' => 'required',
            'captcha' => 'required|captcha'
        ]);
        
        $mailFromAddress = Config::get('mail.from.address');
        $name = $request->name;
        $email = $request->email_id;
        $phone = $request->phone;
        $city = $request->city;
        $category = $request->category;
        $duration = $request->duration;
        $size = $request->size;
        $position = $request->position;
        $comment = $request->comment;
        $mailData = [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "city" => $city,
            "category" => $category,
            "duration" => $duration,
            "size" => $size,
            "position" => $position,
            "comment" => $comment
        ]; 
        try{
            Mail::to($email,)->send(new AdvertisementFormUserMail($mailData));
            Mail::to($mailFromAddress)->send(new AdvertisementFormAdminMail($mailData));
        }catch(\Exception $e){ 
        // return redirect()->back()->with('not_sent', $e->getMessage()); 
        } 
        return redirect()->back()->with('sent', "Your enquiry has been submitted !");  
    }

   public function reminderTest(){
    return view('email.advertisement_reminder');
   }
}

