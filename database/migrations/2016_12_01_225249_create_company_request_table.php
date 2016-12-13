<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyRequestTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(
			 'company_requests_data',
			 function (Blueprint $table) {
			$table->increments('id');
			$table->string('contact_person');
			$table->string('email');
			$table->string('company_name');
			$table->string('project_request'); 
			$table->integer('processed')->default(0); 
			$table->timestamps();
		}
		 );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company_requests_data');
	}
}
