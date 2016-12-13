<?php
use App\User as User;
use App\Role as Role;
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\DB; 
 


class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$role_user 		= Role::where('name','site_manager')->first();
		$role_developer = Role::where('name','developer')->first();
		$role_super 	= Role::where('name','super_admin')->first();
		$role_client 	= Role::where('name','client')->first();
		//var_dump($role_developer->attributes->id);
		$user 				= new User();
		$user->name 		= 'Site';
		$user->last_name 	= 'Manager';
		$user->login 		= 'site_manager';
		$user->email 		= 'site_manager1@company.com';
		$user->password 	= bcrypt('site_manager');
		$user->save();                      
		$user->roles()->attach($role_user);
		
		$developer 				= new User();
		$developer->name 		= 'New';
		$developer->last_name 	= 'Developer';
		$developer->login 		= 'developer';
		$developer->email 		= 'developer@company.com';
		$developer->password 	= bcrypt('developer');
		$developer->save();
		$developer->roles()->attach($role_developer);
		
		$super_admin 			= new User();
		$super_admin->name 		= 'Super';
		$super_admin->last_name = 'Admin';
		$super_admin->login 	= 'super_admin';
		$super_admin->email 	= 'super_admin@company.com';
		$super_admin->password 	= bcrypt('super_admin');
		$super_admin->save();
		$super_admin->roles()->attach($role_super);
		
		$client 			= new User();
		$client->name 		= 'Company';
		$client->last_name 	= 'client';
		$client->login 		= 'client';
		$client->email 		= 'company_client@company.com';
		$client->password 	= bcrypt('client');
		$client->save();
		$client->roles()->attach($role_client);
	}
}
