<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'comment',
        'comment_approval_status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id')->where('comment_approval_status', 1);
    }

    public function replies_for_admin(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parentComment(){
        return $this->belongsTo(Comment::class, 'parent_id')->where('comment_approval_status', 1);
    }
    
}
