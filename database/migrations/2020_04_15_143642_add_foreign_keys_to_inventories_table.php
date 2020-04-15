<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventories', function(Blueprint $table)
		{
			$table->foreign('camera_id')->references('id')->on('cameras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('library_id')->references('id')->on('libraries')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('status_id')->references('id')->on('inventory_status')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventories', function(Blueprint $table)
		{
			$table->dropForeign('inventories_camera_id_foreign');
			$table->dropForeign('inventories_library_id_foreign');
			$table->dropForeign('inventories_status_id_foreign');
		});
	}

}
