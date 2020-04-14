<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviseInventoriesStatusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('inventories', function(Blueprint $table) {
            $table->dropForeign(['equipment_status_id']);
            $table->dropColumn('equipment_status_id');
            $table->dropForeign(['availability_status_id']);
            $table->dropColumn('availability_status_id');
            $table->integer('status_id')->unsigned();
        });

        //Schema::drop('availability_status_timestamps');
        Schema::drop('equipment_status');
        Schema::drop('availability_status');
        */
        Schema::create('inventory_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name')->nullable()->default(null);
            $table->string('status_code', 10)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function(Blueprint $table) {
            $table->integer('equipment_status_id');
            $table->integer('availability_status_id');
            $table->dropColumn('status_id');
        });
        Schema::create('availability_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name')->nullable()->default(null);
            $table->string('status_code')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
        });
        Schema::create('equipment_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('equipment_status_name')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
        });
        Schema::drop('inventory_status');
    }
}
