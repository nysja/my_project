<?php

use Illuminate\Database\Seeder;
use App\Projects as Projects;

class ProjectsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$project1 = new Projects();
		$project1->project_name 		= 'Project1';
		$project1->project_description 	= 'Create web site';
		$project1->project_costs 		= '1000$';
		$project1->company_id 			= '1';
		$project1->save();
		
		$project2 = new Projects();
		$project2->project_name 		= 'Project2';
		$project2->project_description 	= 'Create web site';
		$project2->project_costs 		= '1500$';
		$project2->company_id 			= '2';
		$project2->save();
		
		$project3 = new Projects();
		$project3->project_name 		= 'Project3';
		$project3->project_description 	= 'Create web site';
		$project3->project_costs 		= '2000$';
		$project3->company_id 			= '1';
		$project3->save();
		
	}
}
