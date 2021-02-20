<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likepost extends Model
{
    use HasFactory;
    public  $timestamps=false;
    protected $fillable=['id','user_id','post_id'];
    protected $hidden=[];
    protected $table='likepost';

    public function likesPost(){
    return $this->belongsTo(posts::class,'post_id');
    }

    public function likesUserPost(){
        return $this->belongsTo(User::class,'user_id');
    }

}
