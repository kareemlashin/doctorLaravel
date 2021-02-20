<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profiledoctor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'birthday', 'phone', 'price', 'view', 'text', 'header', 'facebook', 'insgram', 'twitter', 'website', 'linkediin', 'profile', 'gender_id', 'location_id', 'age'];
    protected $hidden = [];
    protected $table = 'profiledoctors';

    public function clinics(){
        return $this->hasMany(clinic::class,'profiledoctors_id');
    }

    public function experience(){
        return $this->hasMany(experience::class,'profiledoctors_id');
    }

    public function doctorprofile()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gender()
    {
        return $this->belongsTo(gender::class, 'gender_id');
    }

    public function location()
    {
        return $this->belongsTo(location::class, 'location_id');
    }

    public function posts(){
        return $this->hasMany(posts::class,'profiledoctors_id');
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function specialtiesdoctor()
    {
        return $this->belongsToMany(specialtie::class, 'specialtiesdoctor', 'profiledoctors_id', 'specialties_id');
    }

    public function titlesdoctor()
    {
        return $this->belongsToMany(titles::class, 'titlesdoctor', 'profiledoctors_id', 'title_id');
    }

    public function service()
    {
        return $this->hasMany(service::class, 'profiledoctors_id');
    }

    public function offer()
    {
        return $this->hasMany(offer::class, 'profiledoctors_id');
    }

    public function education()
    {
        return $this->hasMany(education::class, 'profiledoctors_id');
    }

}
