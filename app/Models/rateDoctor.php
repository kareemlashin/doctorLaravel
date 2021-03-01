<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rateDoctor extends Model
{
    use HasFactory;
    public  $timestamps=false;
    protected $fillable=['id','user_id','profiledoctors_id','rate','review'];
    protected $hidden=[];
    protected $table='rateDoctor';
    public function rateDoctor(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function rate(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }

}
