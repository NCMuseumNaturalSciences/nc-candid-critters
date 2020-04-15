<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCamerasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cameras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('make', 191)->nullable();
			$table->string('model', 191)->nullable();
			$table->string('trigger_speed', 191)->nullable();
			$table->string('product_url', 191)->nullable();
			$table->string('remarks', 1000)->nullable();
			$table->timestamps();
			$table->boolean('acceptable_yn')->default(1);
			$table->string('model_number', 191)->nullable();
			$table->string('make_model', 500)->nullable();
			$table->index(['make','model'], 'fulltext_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cameras');
	}

}
