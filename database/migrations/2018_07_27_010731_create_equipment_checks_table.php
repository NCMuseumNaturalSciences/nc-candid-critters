<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipmentChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipment_checks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('batteries_yn')->default(0);
			$table->text('batteries_remarks', 65535)->nullable();
			$table->boolean('lock_yn')->default(0);
			$table->text('lock_remarks', 65535)->nullable();
			$table->boolean('sd_cards_yn')->default(0);
			$table->text('sd_cards_remarks', 65535)->nullable();
			$table->boolean('camera_yn')->default(0);
			$table->text('camera_remarks', 65535)->nullable();
			$table->text('remarks', 65535)->nullable();
			$table->timestamps();
			$table->integer('inventory_id')->unsigned()->index('equipment_checks_inventory_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipment_checks');
	}

}
