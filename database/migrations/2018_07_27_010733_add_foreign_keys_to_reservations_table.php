<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reservations', function(Blueprint $table)
		{
			$table->foreign('library_id')->references('id')->on('libraries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('volunteer_id')->references('id')->on('volunteers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reservations', function(Blueprint $table)
		{
			$table->dropForeign('reservations_library_id_foreign');
			$table->dropForeign('reservations_volunteer_id_foreign');
		});
	}

}
