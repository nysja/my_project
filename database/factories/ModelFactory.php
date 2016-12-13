<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' 		=> $faker->name,
		'last_name' => $faker->lastName,
		'login' 	=> $faker->userName,
		'email' 	=> $faker->unique()->safeEmail,
		'password' 	=> $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
	return [
		'company_name' 		=> $faker->name,
		'company_phone' 	=> $faker->phoneNumber,
		'company_emails' 	=> $faker->unique()->safeEmail,
		'company_contact_person' => $faker->firstName.' '.$faker->lastName,
	];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
	return [
		'name' 			=> $faker->name,
		'description' 	=> $faker->sentence,   
	];
});

