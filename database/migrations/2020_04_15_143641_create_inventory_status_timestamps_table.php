<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryStatusTimestampsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_status_timestamps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inventory_id')->unsigned()->index('inventory_status_timestamps_inventory_id_foreign');
			$table->integer('inventory_status_id')->unsigned()->index('inventory_status_timestamps_inventory_status_id_foreign');
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
		Schema::drop('inventory_status_timestamps');
	}

}
