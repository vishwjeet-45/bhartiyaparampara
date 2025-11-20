<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstBannerWidget extends Model
{
    use HasFactory;
    protected $fillable = [
        "image",
        "title",
        "url",
        "status",
        "user_id"
    ];

    
}
