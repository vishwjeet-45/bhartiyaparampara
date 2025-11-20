<?php

namespace App\Models\backend;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        "main_category_id", "question_en", "question_hi", "user_id", "question_status"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class)->where('answer_approval_status', 1)->orderBy('id', 'desc');
    }
    public function answers_for_admin(){
        return $this->hasMany(Answer::class)->orderBy('id', 'desc');
    }

    public function answers_for_user(){
        return $this->hasMany(Answer::class)->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
    }

    public function mainCategory(){
        return $this->belongsTo(MainCategory::class)->where('main_category_status', 1);
    }
}
