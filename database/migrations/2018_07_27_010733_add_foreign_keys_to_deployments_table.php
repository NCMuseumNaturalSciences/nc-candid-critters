<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDeploymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->foreign('site_description_id')->references('id')->on('site_descriptions')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('volunteer_id')->references('id')->on('volunteers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('deployments', function(Blueprint $table)
		{
			$table->dropForeign('deployments_site_description_id_foreign');
			$table->dropForeign('deployments_volunteer_id_foreign');
		});
	}

}
