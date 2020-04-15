<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibraryVolunteerAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('library_volunteer_assignments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('library_id')->unsigned()->index('library_volunteer_assignments_library_id_foreign');
			$table->integer('volunteer_id')->unsigned()->index('library_volunteer_assignments_volunteer_id_foreign');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('library_volunteer_assignments');
	}

}
