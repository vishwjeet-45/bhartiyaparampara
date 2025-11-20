<?php

namespace App\Models\frontend; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $fillable = [
        "email",
        "user_type",
        "status"
    ];

}
