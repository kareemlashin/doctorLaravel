<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clinic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'tittle_ar', 'tittle_en', 'lat','lang','description_en','description_ar','address','phone','profiledoctors_id'];
    protected $hidden = [];
    protected $table = 'clinics';

    public function ClinicImage(){
        return $this->hasMany(clinicImage::class,'clinic_id');
    }

    public function clinics(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }
}
