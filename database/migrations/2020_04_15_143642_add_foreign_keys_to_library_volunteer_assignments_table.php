<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLibraryVolunteerAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('library_volunteer_assignments', function(Blueprint $table)
		{
			$table->foreign('library_id')->references('id')->on('libraries')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('volunteer_id')->references('id')->on('volunteers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('library_volunteer_assignments', function(Blueprint $table)
		{
			$table->dropForeign('library_volunteer_assignments_library_id_foreign');
			$table->dropForeign('library_volunteer_assignments_volunteer_id_foreign');
		});
	}

}
