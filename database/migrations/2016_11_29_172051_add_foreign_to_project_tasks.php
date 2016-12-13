<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToProjectTasks extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_tasks', function ($table) {
	
			$table->integer('project_id')->unsigned();

			
			$table->foreign('project_id')
				  ->references('project_id')->on('projects')
				  ->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->dropForeign(['project_id']);
	}
}
