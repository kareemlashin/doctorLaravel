<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['role_id', 'user_id', 'user_type'];
    protected $hidden = [];
    protected $table = 'role_user';

    public function hasRoleAll()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
