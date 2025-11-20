<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_by', 'meta_title', 'meta_keyword', 'meta_description', 'short_description', 'slug', 'main_category_id', 'category_id',
        'sub_category_id', 'thumbnail_image', 'post_data', 'post_status', 'tags', 'post_approval_status', 'approval_comment',
        'post_language', 'views', 'publish_on'
    ];

    protected $casts = [
        'main_category_id' => 'array',
        'category_id' => 'array',
        'sub_category_id' => 'array',
    ];
    
    public function getUser(){
        return $this->belongsTo(User::class, 'post_by');
    }

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id')->where('comment_approval_status', 1)->orderBy('id', 'desc');
    }
    // public function getWriterName(){
    //     return $this->belongsTo(User::class, 'post_by');
    // }
}
