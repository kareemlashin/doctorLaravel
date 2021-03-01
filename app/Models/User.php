<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function hasRoleAll()
    {
        return $this->hasOne(roleUser::class,'user_id');
    }

    public function doctorprofile()
    {
        return $this->hasOne(profiledoctor::class,'user_id');
    }

    public function userrate(){
        return $this->hasMany(ratingPost::class,'user_id');
    }

    public function likesUserPost(){
        return $this->hasMany(likepost::class,'user_id');
    }
    public function likesDoctor(){
        return $this->hasMany(likeDoctor::class,'user_id');
    }
    public function rateDoctor(){
        return $this->hasMany(rateDoctor::class,'user_id');
    }

    public function patient()
    {
        return $this->hasOne(patient::class,'user_id');
    }

}
