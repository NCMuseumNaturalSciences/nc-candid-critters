<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
        });
        Schema::table('inventories', function (Blueprint $table) {
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
        Schema::drop('inventory_status');
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
}
