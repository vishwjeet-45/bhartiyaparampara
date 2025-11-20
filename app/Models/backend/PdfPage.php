<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfPage extends Model
{
    use HasFactory;

    protected $fillable = [
        "page_name_en",
        "page_name_hi",
        "meta_title_en",
        "meta_keyword_en",
        "meta_description_en",
        "meta_title_hi",
        "meta_keyword_hi",
        "meta_description_hi",
        "short_description_hi",
        "slug",
        "thumbnail_image",
        "tags",
        "page_language",
        "views",
        "page_status"
    ];

    

    public static function getPdfPages(){
        return PdfPage::where('page_status', 1)->get();
    }
}
