<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syndrome extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'name_ar', 'name_en','description_ar','description_en'];
    protected $hidden=[];
    protected $table='syndromes';
}
//
