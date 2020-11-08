<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
	use SoftDeletes;
    protected $fillable = ['role_id', 'user_id'];

     public function role()
      {
        return $this->hasOne('App\Models\Roles');
      }
}
