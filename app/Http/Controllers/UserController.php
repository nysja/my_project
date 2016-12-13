<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Role;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function __construct()
	 {
		$this->middleware('auth');
		$this->middleware('roles');
	 }
	 
	public function showList(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   $users = array();
	   if($user_role == 'super_admin')
	   {
		   $users = DB::table('users')->select('id', 'name', 'last_name', 'login', 
					'email', 'companies.company_name')
					->join('companies', 'companies.company_id', '=', 'users.company_id')
					->get();
		   
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   return view('users_list', compact('users'));
   }
   
   
   public function showUser(Request $request, $id){
	   
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   
	   $users = array();
	   if($user_role == 'super_admin')
	   {
		   $users = DB::table('users')->select('id', 'name', 'last_name', 'login', 
					'email', 'companies.company_name', 'companies.company_id','users_roles.role_id')
					->join('companies', 'companies.company_id', '=', 'users.company_id')
					->join('users_roles', 'users.id', '=', 'users_roles.user_id')
					->where('users.id', $id)
					->get();  
		   $companies = Company::all(['company_id', 'company_name', 'company_phone', 
									'company_emails', 'company_contact_person']); 
		   $roles = Role::all('id', 'description');   
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   
	   return view('user_item', compact('users','companies','roles'));
   }
   
   
   /**
	 * create user instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */ 
	 public function createUser(Request $request){
		$validator= Validator::make($request->all(), [
			'name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'login' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
			'company_id' => 'required|min:1',
			'role_id' => 'required|min:1',
	]);
	
		if ($validator->fails()) {
			return redirect('/user_add')
						->withErrors($validator)
						->withInput();
		}
		$user = new User;
		
		$user->name = $request->name;
		$user->last_name = $request->last_name;
		$user->login = $request->login;
		$user->email = $request->email;
		$user->password = $request->password;
		$user->company_id = $request->company_id;
		$user->save();
		$user->roles()->attach($request->role_id);
		$id = $user->id;
		return redirect('/user/'.$id)-> with('status', 'User info saved successfully!');
	}
	
	 public function addUser(Request $request){
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   if(!$request->user() && $user_role!='super_admin')
	   {
		   return view('\login');
	   }
	   $companies = Company::all(['company_id', 'company_name', 'company_phone', 
									'company_emails', 'company_contact_person']); 
	   $roles = Role::all('id', 'description');
	   return view('user_add', compact('companies','roles'));
	 }
   
	/**
	 * edit user instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function edit(Request $request, $id){
		
		$validator= Validator::make($request->all(),  [
			'name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'login' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
			'company_id' => 'required|min:1',
	]);
	
		if ($validator->fails()) {
			return redirect('/user/'.$id)
						->withErrors($validator)
						->withInput();
		}
		$user = new User;
		
		$user->name = $request->name;
		$user->last_name = $request->last_name;
		$user->login = $request->login;
		$user->email = $request->email;
		$user->password = $request->password;
		$user->company_id = $request->company_id;
		$user->save();
		$user->roles()->detach();
		$user->roles()->attach($request->role_id);
		
		return redirect('/user/'.$id)-> with('status', 'User info changed successfully!');
	}
}
