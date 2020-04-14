<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryReservationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_reservation', function(Blueprint $table)
		{
			$table->integer('inventory_id')->unsigned()->index();
			$table->integer('reservation_id')->unsigned()->index();
			$table->primary(['inventory_id','reservation_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventory_reservation');
	}

}
