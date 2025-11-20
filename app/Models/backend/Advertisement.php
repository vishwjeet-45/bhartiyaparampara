<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "image",
        "start_date",
        "end_date",
        "size",
        "position",
        "price",
        "status",
        "email",
        "reminder_date",
        "reminder_count",
        "running_status",
        "target_url",
    ];
}
