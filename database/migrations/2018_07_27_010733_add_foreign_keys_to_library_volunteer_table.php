<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLibraryVolunteerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('library_volunteer', function(Blueprint $table)
		{
			$table->foreign('library_id')->references('id')->on('libraries')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('volunteer_id')->references('id')->on('volunteers')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('library_volunteer', function(Blueprint $table)
		{
			$table->dropForeign('library_volunteer_library_id_foreign');
			$table->dropForeign('library_volunteer_volunteer_id_foreign');
		});
	}

}
