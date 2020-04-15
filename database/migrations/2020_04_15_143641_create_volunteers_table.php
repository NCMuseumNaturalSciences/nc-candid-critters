<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVolunteersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('volunteers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('telephone', 191)->nullable();
			$table->string('organization', 191)->nullable();
			$table->string('county', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('zip_code', 191)->nullable();
			$table->text('admin_remarks', 65535)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('volunteers_user_id_foreign');
			$table->boolean('acf_borrower_yn')->default(0);
			$table->boolean('acf_uploader_yn')->default(0);
			$table->timestamps();
			$table->integer('signup_id')->unsigned()->index('volunteers_signup_id_foreign');
			$table->string('status', 191)->nullable();
			$table->date('activation_date')->nullable();
			$table->integer('number_deployments')->default(0);
			$table->string('number_deployments_registered', 191)->nullable();
			$table->string('number_deployments_uploaded', 191)->nullable();
			$table->text('libraries_notes', 65535)->nullable();
			$table->boolean('koozie_yn')->default(0);
			$table->boolean('koozie_form_sent_yn')->default(0);
			$table->boolean('tshirt_form_sent_yn')->default(0);
			$table->boolean('tshirt_sent_yn')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('volunteers');
	}

}
