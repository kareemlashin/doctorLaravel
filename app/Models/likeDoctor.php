<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likeDoctor extends Model
{
    use HasFactory;
    public  $timestamps=false;
    protected $fillable=['id','user_id','profiledoctors_id'];
    protected $hidden=[];
    protected $table='likeDoctor';

    public function likesDoctor(){
        return $this->belongsToMany(User::class,'user_id');
    }
    public function likes(){
        return $this->belongsToMany(profiledoctor::class,'user_id');
    }


}
