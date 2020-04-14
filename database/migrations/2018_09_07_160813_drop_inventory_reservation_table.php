<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropInventoryReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('inventory_reservation');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('inventory_reservation', function(Blueprint $table)
        {
            $table->integer('inventory_id')->unsigned()->index();
            $table->integer('reservation_id')->unsigned()->index();
            $table->primary(['inventory_id','reservation_id']);
        });
    }
}
