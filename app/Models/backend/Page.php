<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'slug',
        'main_category_id',
        'category_id',
        'sub_category_id',
        'page_data',
        'page_status',
        'tags',
        'page_language',
        'views',
        'is_category',
        'menu_place'
    ];

    public static function getPages(){
        return Page::where('page_status', 1)->get();
    }
}
