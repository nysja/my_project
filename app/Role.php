<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Support\Facades\DB;
use App\User;
class Role extends Model
{
	/**
	  * Get users with a certain role
	  */
	 public function users()
	 {
		 return $this->belongsToMany('User', 'users_roles', 'role_id');
	 }
}
