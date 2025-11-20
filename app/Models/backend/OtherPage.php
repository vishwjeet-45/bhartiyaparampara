<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class OtherPage extends Model
{
    use HasFactory;
    protected $fillable=[
        "page_name",
        "meta_title",
        "meta_keyword",
        "meta_description",
        "short_description",
        "thumbnail_image",
        "slug",
        "page_data",
        "page_status",
        "tags",
        "page_language",
        "views"
    ];

    
 
}
