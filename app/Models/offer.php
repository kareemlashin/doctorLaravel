<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'name_ar', 'name_en', 'price', 'description_ar', 'description_en', 'profiledoctors_id'];
    protected $hidden=[];
    protected $table='offer';
    public function offer(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }
}
