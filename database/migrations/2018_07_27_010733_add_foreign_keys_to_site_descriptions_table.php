<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSiteDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('site_descriptions', function(Blueprint $table)
		{
			$table->foreign('camera_id')->references('id')->on('cameras')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('map_site_id')->references('id')->on('map_sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('site_descriptions', function(Blueprint $table)
		{
			$table->dropForeign('site_descriptions_camera_id_foreign');
			$table->dropForeign('site_descriptions_map_site_id_foreign');
		});
	}

}
