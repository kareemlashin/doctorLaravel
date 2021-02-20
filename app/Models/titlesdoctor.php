<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class titlesdoctor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'profiledoctors_id', 'title_id'];
    protected $hidden = [];
    protected $table = 'titlesdoctor';
}
