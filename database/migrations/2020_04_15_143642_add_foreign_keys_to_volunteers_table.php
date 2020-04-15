<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVolunteersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('volunteers', function(Blueprint $table)
		{
			$table->foreign('signup_id')->references('id')->on('signups')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('volunteers', function(Blueprint $table)
		{
			$table->dropForeign('volunteers_signup_id_foreign');
			$table->dropForeign('volunteers_user_id_foreign');
		});
	}

}
