<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CombineInventoryEquipmentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->boolean('batteries_yn')->default(0);
            $table->boolean('lock_yn')->default(0);
            $table->boolean('sd_cards_yn')->default(0);
            $table->boolean('camera_yn')->default(0);
            $table->text('equipment_remarks', 65535)->nullable();
        });
        Schema::drop('equipment_checks');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('equipment_checks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->boolean('batteries_yn')->default(0);
            $table->text('batteries_remarks', 65535)->nullable();
            $table->boolean('lock_yn')->default(0);
            $table->text('lock_remarks', 65535)->nullable();
            $table->boolean('sd_cards_yn')->default(0);
            $table->text('sd_cards_remarks', 65535)->nullable();
            $table->boolean('camera_yn')->default(0);
            $table->text('camera_remarks', 65535)->nullable();
            $table->text('remarks', 65535)->nullable();
            $table->timestamps();
            $table->integer('inventory_id')->unsigned()->index('equipment_checks_inventory_id_foreign');
        });
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('batteries_yn');
            $table->dropColumn('lock_yn');
            $table->dropColumn('sd_cards_yn');
            $table->dropColumn('camera_yn');
            $table->dropColumn('equipment_remarks');
        });
    }
}
