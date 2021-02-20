<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = ['id', 'tittle_ar', 'title_en', 'viewer', 'description_ar', 'description_en', 'profiledoctors_id','photo','create_at','ago'];
    protected $hidden=[];
    protected $table='posts';

    public function getAgoAttribute()
    {
        $t1 = Carbon::parse($this->attributes['create_at']);
        $t2 = Carbon::parse(now());
        $diff = $t1->diff($t2);
        return $diff;
    }

    public function postTags(){
        return $this->belongsToMany(tags::class,'tagsPosts','post_id','tag_id');
    }

    public function user(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }

    public function postrate(){
        return $this->hasMany(ratingPost::class,'post_id');
    }

    public function likesPost(){
        return $this->hasMany(likepost::class,'post_id');
    }

}
