<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'country_ar', 'country_en', 'city_ar', 'city_en','code','key'];
    protected $hidden = [];
    protected $table = 'locations';
    public function location()
    {
        return $this->hasMany(profiledoctor::class,'location_id');
    }
    public function locationPatient()
    {
        return $this->hasMany(patient::class,'gender_id');
    }
}
