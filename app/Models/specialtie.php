<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialtie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'specialties_ar', 'specialties_en', 'photo', 'description'];
    protected $hidden = [];
    protected $table = 'specialties';

}
