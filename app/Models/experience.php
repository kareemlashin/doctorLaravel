<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class experience extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'name_ar', 'name_en', 'start_date', 'end_date', 'profiledoctors_id', 'sum_year', 'description_en', 'description_ar'];
    protected $hidden = [];
    protected $table = 'experience';
    public function userExperience(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }

}
