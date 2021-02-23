<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diseasePatient extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'patient_id', 'disease_id'];
    protected $hidden=[];
    protected $table='patient_diseases';
}
