<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialtiesdoctor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'specialties_id', 'profiledoctors_id'];
    protected $hidden = [];
    protected $table = 'specialtiesdoctor';
}
