<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibraryVolunteerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('library_volunteer', function(Blueprint $table)
		{
			$table->integer('library_id')->unsigned()->index();
			$table->integer('volunteer_id')->unsigned()->index();
			$table->primary(['library_id','volunteer_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('library_volunteer');
	}

}
