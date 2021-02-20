<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gender extends Model
{
    use HasFactory;
    public  $timestamps=false;
    protected $fillable=['id','name_ar','name_en','photo'];
    protected $hidden=[];
    protected $table='genders';

    public function gender()
    {
        return $this->hasMany(profiledoctor::class,'gender_id');
    }

}
