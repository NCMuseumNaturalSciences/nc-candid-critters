<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_descriptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('emammal_user_id', 191)->nullable();
			$table->string('delivery_method', 191)->nullable();
			$table->string('mailing_address_sd', 191)->nullable();
			$table->string('mailing_address_stamps', 191)->nullable();
			$table->string('county', 191)->nullable();
			$table->string('site_type', 1000)->nullable();
			$table->boolean('school_property_yn')->default(0);
			$table->string('camera_facing', 191)->nullable();
			$table->string('property_type', 191)->nullable();
			$table->string('property_name', 191)->nullable();
			$table->boolean('fenced_yn')->default(0);
			$table->boolean('hunting_yn')->default(0);
			$table->string('hunting_details', 1000)->nullable();
			$table->boolean('purposeful_feeding_yn')->default(0);
			$table->boolean('accidental_food_yn')->default(0);
			$table->boolean('outside_pets_yn')->default(0);
			$table->integer('camera_id')->unsigned()->nullable()->index('site_descriptions_camera_id_foreign');
			$table->timestamps();
			$table->float('user_latitude', 10, 0)->nullable();
			$table->float('user_longitude', 10, 0)->nullable();
			$table->boolean('acf_uploader_yn')->default(0);
			$table->boolean('acf_borrower_yn')->default(0);
			$table->boolean('outside_dogs_yn')->default(0);
			$table->boolean('outside_cats_yn')->default(0);
			$table->boolean('outside_chickens_yn')->default(0);
			$table->boolean('outside_horses_yn')->default(0);
			$table->boolean('outside_none_yn')->default(0);
			$table->string('deployment_name', 191)->nullable();
			$table->integer('map_site_id')->unsigned()->nullable()->index('site_descriptions_map_site_id_foreign');
			$table->date('date_submitted')->nullable();
			$table->boolean('deployment_yn')->default(0);
			$table->boolean('imported_yn')->default(0);
			$table->string('gsheet_src', 191)->nullable();
			$table->float('acf_lat', 10, 0)->nullable();
			$table->float('acf_long', 10, 0)->nullable();
			$table->string('camera_import_text', 1000)->nullable();
			$table->boolean('emammal_created_yn')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_descriptions');
	}

}
