<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\backend\SocialMedia;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'gender',   
        'phone_number',
        'country',
        'state',
        'city',
        'bio_en',
        'bio_hi', 
        'meta_title_hi',
        'meta_description_hi',
        'meta_keyword_hi',
        'meta_title_en',
        'meta_description_en',
        'meta_keyword_en',  
        'writer_account_status',
        'profile_image',
        'poster_image',
        'certificate',
        'term_and_condition'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function SocialMedia(){
        return $this->hasOne(SocialMedia::class);
    }
}
