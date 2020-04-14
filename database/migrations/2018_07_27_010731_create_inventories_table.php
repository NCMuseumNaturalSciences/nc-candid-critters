<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('camera_id')->unsigned()->index('inventories_camera_id_foreign');
			$table->integer('library_id')->unsigned()->index('inventories_library_id_foreign');
			$table->string('status', 191)->nullable();
			$table->string('status_details', 1000)->nullable();
			$table->string('remarks', 1000)->nullable();
			$table->string('barcode', 191)->nullable();
			$table->timestamps();
			$table->string('nccc_id', 191)->nullable();
			$table->boolean('functional_yn')->default(0);
			$table->boolean('checked_out_yn')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventories');
	}

}
