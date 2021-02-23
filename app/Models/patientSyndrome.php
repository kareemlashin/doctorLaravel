<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientSyndrome extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'patient_id', 'syndrome_id'];
    protected $hidden=[];
    protected $table='patient_syndromes';

}
