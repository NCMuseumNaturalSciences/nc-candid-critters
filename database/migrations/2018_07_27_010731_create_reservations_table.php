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
			$table->string('checkout_length', 191)->nullable();
			$table->integer('camera_count_checkout')->nullable();
			$table->boolean('reserved_camera_yn')->default(0);
			$table->date('reservation_date')->nullable();
			$table->date('checkout_date')->nullable();
			$table->date('return_date')->nullable();
			$table->boolean('overdue_yn')->default(0);
			$table->boolean('uploaded_yn')->default(0);
			$table->boolean('pictures_drive_yn')->default(0);
			$table->string('missing_equip', 500)->nullable();
			$table->boolean('equip_damage_yn')->default(0);
			$table->string('remarks', 1000)->nullable();
			$table->boolean('reservation_closed_yn')->default(0);
			$table->integer('library_id')->unsigned()->index('reservations_library_id_foreign');
			$table->integer('volunteer_id')->unsigned()->index('reservations_volunteer_id_foreign');
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
		Schema::drop('reservations');
	}

}
