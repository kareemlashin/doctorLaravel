<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTests extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'name_ar', 'name_en','create_at','image','patient_id'];
    protected $hidden=[];
    protected $table='medicalTests';
    public  function medicalTests(){
        //
        return $this->belongsTo(patient::class, 'patient_id');
    }
}
