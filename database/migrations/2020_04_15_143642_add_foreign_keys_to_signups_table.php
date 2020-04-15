<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSignupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('signups', function(Blueprint $table)
		{
			$table->foreign('training_status_id')->references('id')->on('training_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('signups', function(Blueprint $table)
		{
			$table->dropForeign('signups_training_status_id_foreign');
		});
	}

}
