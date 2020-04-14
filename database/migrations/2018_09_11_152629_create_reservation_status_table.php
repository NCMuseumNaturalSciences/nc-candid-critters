<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservation_status');
    }
}
