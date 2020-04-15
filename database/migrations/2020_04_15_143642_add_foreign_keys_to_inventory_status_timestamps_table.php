<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventoryStatusTimestampsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventory_status_timestamps', function(Blueprint $table)
		{
			$table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('inventory_status_id')->references('id')->on('inventory_status')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventory_status_timestamps', function(Blueprint $table)
		{
			$table->dropForeign('inventory_status_timestamps_inventory_id_foreign');
			$table->dropForeign('inventory_status_timestamps_inventory_status_id_foreign');
		});
	}

}
