<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEquipmentChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equipment_checks', function(Blueprint $table)
		{
			$table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('equipment_checks', function(Blueprint $table)
		{
			$table->dropForeign('equipment_checks_inventory_id_foreign');
		});
	}

}
