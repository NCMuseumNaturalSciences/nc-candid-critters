<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeploymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deployments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('deployment_lat', 10, 0)->nullable();
			$table->float('deployment_long', 10, 0)->nullable();
			$table->string('deployment_name', 191)->nullable();
			$table->boolean('sent_sd_yn')->default(0);
			$table->string('sd_card_id', 191)->nullable();
			$table->boolean('google_drive_yn')->default(0);
			$table->boolean('received_data_yn')->default(0);
			$table->boolean('returned_sd_card_yn')->default(0);
			$table->string('remarks', 191)->nullable();
			$table->boolean('nu_participant_yn')->default(0);
			$table->text('cc_team_remarks', 65535)->nullable();
			$table->integer('site_description_id')->unsigned()->index('deployments_site_description_id_foreign');
			$table->timestamps();
			$table->string('emammal_deployment_id', 191)->nullable();
			$table->integer('volunteer_id')->unsigned()->nullable()->index('deployments_volunteer_id_foreign');
			$table->boolean('acf_uploader_yn')->default(0);
			$table->boolean('acf_borrower_yn')->default(0);
			$table->string('sent_sd_card_id', 191)->nullable();
			$table->string('returned_sd_card_id', 191)->nullable();
			$table->string('upload_status', 191)->nullable()->default('No');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deployments');
	}

}
