<?php

use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; 
use App\Role as Role;

class RoleTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = new Role();
		$user->name = 'site_manager';
		$user->description = 'Site Manager';
		$user->save();
		
		$developer = new Role();
		$developer->name = 'developer';
		$developer->description = 'Developer';
		$developer->save();
		
		$super_admin = new Role();
		$super_admin->name = 'super_admin';
		$super_admin->description = 'Super Admin';
		$super_admin->save();
		
		$client = new Role();
		$client->name = 'client';
		$client->description = 'Company client';
		$client->save();
		
		
	}
}
