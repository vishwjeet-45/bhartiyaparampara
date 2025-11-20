<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "main_category_id",
        "category_id",
        "sub_category_name_en",
        "sub_category_name_hi",
        "sub_category_thumbnail",
        "sub_category_short_description_en",
        "sub_category_short_description_hi",
        'meta_title_en', 
        'meta_description_en', 
        'meta_keyword_en', 
        'meta_title_hi', 
        'meta_description_hi', 
        'meta_keyword_hi', 
        "sub_category_status",
        "slug"
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function mainCategory(){
        return $this->belongsTo(MainCategory::class, "main_category_id");
    }

    
}
