<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use App\Role;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'last_name', 'login', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	  * Get the roles a user has
	  */
	 public function roles()
	 {
		 return $this->belongsToMany('App\Role', 'users_roles', 'user_id');
	 }
 
	 public function hasAnyRole($roles)
	 {
		 if(is_array($roles)){
			 foreach($roles as $role){
				 if($this->hasRole($role)){
					 return true;
				 }
			 } 
		 }else{
			  if($this->hasRole($roles)){
					 return true;
				 }
		 }
		 return false;
	 }
	 
	 /**
	  * Find out if user has a specific role
	  *
	  * $return boolean
	  */
	 public function hasRole($role)
	 {
		 if($this->roles()->where('name', $role)->first()){
			 return true;
		 }
		 return false;                
	 }
	 
	 public function getUserRole($id)
	 {
		$role = DB::table('users')->select('roles.name as role')
		->join('users_roles', 'users_roles.user_id', '=', 'users.id')
		->join('roles', 'users_roles.role_id', '=', 'roles.id')
		->where('users.id', $id)->first(); 
		//var_dump($role); 
		return  $role->role;
	 }
 
	 /**
	  * Add roles to user to make them a concierge
	  */
	 /*public function makeEmployee($title)
	 {
		 $assigned_roles = array();
 
		 $roles = array_fetch(Role::all()->toArray(), 'name');
 
		 switch ($title) {
			 case 'super_admin':
				 $assigned_roles[] = $this->getIdInArray($roles, 'edit_customer');
				 $assigned_roles[] = $this->getIdInArray($roles, 'delete_customer');
			 case 'admin':
				 $assigned_roles[] = $this->getIdInArray($roles, 'create_customer');
			 case 'concierge':
				 $assigned_roles[] = $this->getIdInArray($roles, 'add_points');
				 $assigned_roles[] = $this->getIdInArray($roles, 'redeem_points');
				 break;
			 default:
				 throw new \Exception("The employee status entered does not exist");
		 }
 
		 $this->roles()->attach($assigned_roles);
	 }                                  */
}
