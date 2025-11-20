<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "user_type",
        "whatsapp",
        "whatsapp_status",
        "telegram",
        "telegram_status",
        "youtube",
        "youtube_status",
        "linkedin",
        "linkedin_status",
        "x",
        "x_status",
        "facebook",
        "facebook_status",
        "instagram",
        "instagram_status",
        "thread",
        "thread_status"
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
