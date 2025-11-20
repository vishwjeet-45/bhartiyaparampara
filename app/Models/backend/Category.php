<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "main_category_id",
        "category_name_en",
        "category_name_hi",
        "category_thumbnail",
        "category_short_description_en",
        "category_short_description_hi",
        'meta_title_hi', 
        'meta_description_hi', 
        'meta_keyword_hi', 
        'meta_title_en', 
        'meta_description_en', 
        'meta_keyword_en',
        "category_status",
        "slug",
    ];

    public function mainCategory(){
        return $this->belongsTo(MainCategory::class);     
    }

    public function subCategories() {
        return $this->hasMany(SubCategory::class, 'category_id')->where('sub_category_status', 1);
    }
}
