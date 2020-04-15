<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('remarks', 1000)->nullable();
			$table->integer('volunteer_id')->unsigned()->index('reservations_volunteer_id_foreign');
			$table->timestamps();
			$table->integer('inventory_id')->unsigned()->index('reservations_inventory_id_foreign');
			$table->string('librarian_name', 191)->nullable();
			$table->string('librarian_email', 191)->nullable();
			$table->string('librarian_phone', 191)->nullable();
			$table->boolean('equipment_checked_yn')->default(0);
			$table->integer('status_id')->unsigned()->nullable()->index('reservations_status_id_foreign');
			$table->date('open_date')->nullable();
			$table->date('close_date')->nullable();
			$table->boolean('closed_yn')->default(0);
			$table->text('close_remarks', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reservations');
	}

}
