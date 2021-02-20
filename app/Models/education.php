<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'name_ar', 'name_en', 'presente','end_date','profiledoctors_id'];
    protected $hidden = [];
    protected $table = 'educations';
    public function education(){
        return $this->belongsTo(profiledoctor::class,'profiledoctors_id');
    }

}
