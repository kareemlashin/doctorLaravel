<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ratingPost extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = ['id', 'user_id', 'post_id', 'rate', 'review'];
    protected $hidden=[];
    protected $table='ratingPost';
    public function userrate(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function postrate(){
        return $this->belongsTo(posts::class,'post_id');
    }

}
