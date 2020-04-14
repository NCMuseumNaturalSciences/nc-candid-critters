<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibrariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('libraries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('library_name', 191)->nullable();
			$table->string('telephone', 191)->nullable();
			$table->string('contact_first_name', 191)->nullable();
			$table->string('contact_last_name', 191)->nullable();
			$table->string('contact_email', 191)->nullable();
			$table->string('street_address', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('zip', 191)->nullable();
			$table->string('county', 191)->nullable();
			$table->string('region', 191)->nullable();
			$table->boolean('partner_yn')->default(1);
			$table->string('remarks', 500)->nullable();
			$table->timestamps();
			$table->boolean('accepting_volunteers_yn')->default(1);
			$table->float('lat', 8, 5)->nullable();
			$table->float('lon', 8, 5)->nullable();
			$table->string('name_address', 500)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('libraries');
	}

}
