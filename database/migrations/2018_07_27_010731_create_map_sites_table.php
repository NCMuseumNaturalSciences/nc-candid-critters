<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('map_sites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_number')->nullable();
			$table->string('site_name', 191)->nullable();
			$table->float('lat', 10, 0)->nullable();
			$table->float('long', 10, 0)->nullable();
			$table->string('county', 191)->nullable();
			$table->string('land_cover', 191)->nullable();
			$table->string('property_name', 191)->nullable();
			$table->string('remarks', 1000)->nullable();
			$table->string('status', 191)->nullable();
			$table->timestamps();
			$table->string('source_gsheet_name', 191)->nullable();
			$table->boolean('display_on_map_yn')->default(1);
			$table->boolean('fall_site_yn')->default(0);
			$table->boolean('available_yn')->default(0);
			$table->string('infowindow_content', 1200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('map_sites');
	}

}
