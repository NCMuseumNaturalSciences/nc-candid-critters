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
			$table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('status_id')->references('id')->on('reservations_status')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('reservations', function(Blueprint $table)
		{
			$table->dropForeign('reservations_inventory_id_foreign');
			$table->dropForeign('reservations_status_id_foreign');
			$table->dropForeign('reservations_volunteer_id_foreign');
		});
	}

}
