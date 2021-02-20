<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class titles extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'name_ar', 'name_en', 'description'];
    protected $hidden = [];
    protected $table = 'titles';
}
