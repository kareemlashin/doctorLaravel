<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'birthday', 'gender_id', 'location_id', 'age','profile','view'];
    protected $hidden = [];
    protected $table = 'patients';

    public function genderPatient()
    {
        return $this->belongsTo(gender::class, 'gender_id');
    }

    public function locationPatient()
    {
        return $this->belongsTo(location::class, 'location_id');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }
    public  function patientSyndromes(){
        //
        return $this->belongsToMany(Syndrome::class, 'patient_syndromes','patient_id','syndrome_id');

    }
    public  function patientDiseases(){
        //
        return $this->belongsToMany(diseases::class, 'patient_diseases','patient_id','disease_id');
    }
    public  function xRays(){
        //
        return $this->hasMany(Xray::class, 'patient_id');
    }
    public  function medicalTests(){
        //
        return $this->hasMany(MedicalTests::class, 'patient_id');
    }
}
