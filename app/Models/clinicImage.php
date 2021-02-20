<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clinicImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'image','clinic_id'];
    protected $hidden = [];
    protected $table = 'clinic_images';
    public function ClinicImage(){
        return $this->belongsTo(clinic::class,'clinic_id');
    }

}
