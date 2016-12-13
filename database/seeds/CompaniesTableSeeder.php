<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('companies')->insert([
			'company_name' => str_random(10),
			'company_phone' => rand(100000000,999999999),
			'company_emails' => str_random(10).'@gmail.com',
			'company_contact_person' => str_random(10).' '.str_random(10),
		]);
	}
}
