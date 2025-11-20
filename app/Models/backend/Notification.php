<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "notification_type",
        "notification_status",
        "notification_source",
        "user_id"
    ];

    
    public static function getAdminNotification(){
        $startDate = Carbon::now()->subDays(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        return Notification::
            whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'desc') 
            ->get(); 
    }

    public static function getAdminUnreadNotification(){
        $startDate = Carbon::now()->subDays(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        return Notification::
            whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'desc')
            ->where('is_read', 0)
            ->get(); 
    }

    public static function getNotification(){
        
        return Notification::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    }
}
