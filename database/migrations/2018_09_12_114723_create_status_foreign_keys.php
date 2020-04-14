<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('inventory_status')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('reservations_status')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
        });
    }
}
