<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'main_category_name_en',
        'main_category_name_hi',
        'page_type',
        'main_category_status', 
        'main_category_short_description', 
        'meta_title_en', 
        'meta_description_en', 
        'meta_keyword_en', 
        'meta_title_hi', 
        'meta_description_hi', 
        'meta_keyword_hi', 
        'thumbnail', 
        'order_number', 
        'slug', 
    ];

    public static function getMainCategories(){
        return MainCategory::where('main_category_status', 1)->get();
    }
    
    public function getCategories(){
        return $this->hasMany(Category::class)->where('category_status', 1);
    }

    
}
