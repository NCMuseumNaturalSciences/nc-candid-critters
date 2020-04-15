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
			$table->integer('library_id')->unsigned()->nullable()->index('inventories_library_id_foreign');
			$table->string('import_status_str', 191)->nullable();
			$table->string('remarks', 1000)->nullable();
			$table->string('barcode', 191)->nullable();
			$table->timestamps();
			$table->string('nccc_id', 191)->nullable();
			$table->integer('status_id')->unsigned()->default(1)->index('inventories_status_id_foreign');
			$table->boolean('camera_present_yn')->default(1);
			$table->boolean('plastic_box_yn')->default(1);
			$table->boolean('lock_yn')->default(1);
			$table->boolean('item_list_yn')->default(1);
			$table->boolean('batteries_yn')->default(1);
			$table->boolean('sd_cards_yn')->default(1);
			$table->boolean('camera_working_yn')->default(1);
			$table->string('checked_by_name')->nullable();
			$table->string('checked_by_email')->nullable();
			$table->text('checked_remarks', 65535)->nullable();
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
