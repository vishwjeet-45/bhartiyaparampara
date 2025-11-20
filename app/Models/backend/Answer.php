<?php

namespace App\Models\backend;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'question_id', 'parent_id', 'answer'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }  

    public function question_for_user(){
        return $this->belongsTo(Question::class)->where('user_id', Auth::user()->id);
    }  

    

}
