<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        "title_en",
        "title_hi",
        "thumbnail",
        "video_link",
        "type",
        "status"
    ];
}
