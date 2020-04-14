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
			$table->foreign('camera_id')->references('id')->on('cameras')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('library_id')->references('id')->on('libraries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		});
	}

}
