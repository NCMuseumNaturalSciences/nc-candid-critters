<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryStatusForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function(Blueprint $table)
        {
            $table->foreign('equipment_status_id')->references('id')->on('equipment_status')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('availability_status_id')->references('id')->on('availability_status')->onUpdate('CASCADE')->onDelete('CASCADE');
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
            $table->dropForeign(['equipment_status_id']);
            $table->dropColumn('equipment_status_id');
            $table->dropForeign(['availability_status_id']);
            $table->dropColumn('availability_status_id');
        });
    }
}
