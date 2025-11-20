<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Notification;
use Auth;

class NotificationController extends Controller
{
    
    public function allNotification(){
        if(isset($_GET['qty']) && $_GET['qty'] != ''){
            $qty = $_GET['qty'];
        }else{
            $qty = 10;
        }
        
        if(Auth::user()->user_type == 1){
         $all_notification = Notification::orderBy('id', 'desc')->paginate($qty);
        }else{
        $all_notification = Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate($qty);
        }
        return view('backend.notification.index', compact('all_notification'));
    }

}
