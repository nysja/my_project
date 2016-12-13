<?php

use Illuminate\Database\Seeder;
use App\ProjectTasks as ProjectTasks;

class ProjectTasksTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$project_task1 = new ProjectTasks();
		$project_task1->project_task_description = 'create web design';
		$project_task1->project_task_status 	 = '1';
		$project_task1->project_id 				 = '1';
		$project_task1->user_id 				 = '12';
		$project_task1->save();
		
		$project_task2 = new ProjectTasks();
		$project_task2->project_task_description = 'Create backend';
		$project_task2->project_task_status 	 = '1';
		$project_task2->project_id 				 = '1';
		$project_task2->user_id 				 = '12';
		$project_task2->save();
		
		$project_task3 = new ProjectTasks();
		$project_task3->project_task_description = 'Test created site';
		$project_task3->project_task_status 	 = '1';
		$project_task3->project_id 				 = '1';
		$project_task3->user_id 				 = '12';
		$project_task3->save();
		
		$project_task4 = new ProjectTasks();
		$project_task4->project_task_description = 'Create web design';
		$project_task4->project_task_status 	 = '1';
		$project_task4->project_id 				 = '2';
		$project_task4->user_id 				 = '12';
		$project_task4->save();
		
		$project_task5 = new ProjectTasks();
		$project_task5->project_task_description = 'Create backend';
		$project_task5->project_task_status 	 = '1';
		$project_task5->project_id 				 = '2';
		$project_task5->user_id 				 = '12';
		$project_task5->save();
		
		
		
	}
}
