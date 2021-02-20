<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagsPosts extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['id', 'tag_id', 'post_id'];
    protected $hidden=[];
    protected $table='tagsPosts';

}
