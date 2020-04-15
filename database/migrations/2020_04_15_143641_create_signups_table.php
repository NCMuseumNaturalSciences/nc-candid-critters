<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSignupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('commit_upload_yn')->default(0);
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('telephone', 191)->nullable();
			$table->string('organization', 191)->nullable();
			$table->boolean('teacher_yn')->default(0);
			$table->boolean('hunter_yn')->default(0);
			$table->string('camera_location', 1000)->nullable();
			$table->string('county', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('zip_code', 191)->nullable();
			$table->boolean('confirm_nc_yn')->default(0);
			$table->date('desired_start_date')->nullable();
			$table->boolean('pc_verify_yn')->default(0);
			$table->boolean('time_commit_yn')->default(0);
			$table->boolean('library_yn')->default(0);
			$table->boolean('commit_return_yn')->default(0);
			$table->string('delivery_method', 1000)->nullable();
			$table->string('how_learn', 1000)->nullable();
			$table->string('project_ref', 1000)->nullable();
			$table->text('interests', 65535)->nullable();
			$table->text('comments', 65535)->nullable();
			$table->boolean('permission_yn')->default(0);
			$table->boolean('responsible_yn')->default(0);
			$table->text('admin_remarks', 65535)->nullable();
			$table->integer('camera_id')->unsigned()->nullable();
			$table->integer('library_id')->unsigned()->nullable();
			$table->boolean('acf_uploader_yn')->default(0);
			$table->boolean('acf_borrower_yn')->default(0);
			$table->timestamps();
			$table->boolean('volunteer_yn')->default(0);
			$table->boolean('imported_yn')->default(0);
			$table->string('gsheet_src', 191)->nullable();
			$table->boolean('commit_provide_nccc_yn')->default(0);
			$table->date('training_assigned_timestamp')->nullable();
			$table->date('training_completed_timestamp')->nullable();
			$table->string('camera_import_text', 1000)->nullable();
			$table->integer('training_status_id')->unsigned()->default(1)->index('signups_training_status_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signups');
	}

}
