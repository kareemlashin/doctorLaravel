<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'name_ar', 'name_en'];
    protected $hidden=[];
    protected $table='tags';

}
