<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventoryReservationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventory_reservation', function(Blueprint $table)
		{
			$table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventory_reservation', function(Blueprint $table)
		{
			$table->dropForeign('inventory_reservation_inventory_id_foreign');
			$table->dropForeign('inventory_reservation_reservation_id_foreign');
		});
	}

}
