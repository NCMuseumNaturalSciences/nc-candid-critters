<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEquipmentStatusInventories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            //$table->dropForeign(['status_id']);
            //$table->dropColumn('status_id');
            $table->dropColumn('functional_yn');
            $table->dropColumn('checked_out_yn');
            $table->integer('availability_status_id')->unsigned();
            $table->integer('equipment_status_id')->unsigned();
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
        Schema::drop('inventory_reservation');
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropColumn('camera_count_checkout');
            $table->dropColumn('reserved_camera_yn');
            $table->dropColumn('missing_equip');
            $table->boolean('missing_equip_yn')->default(0);
            $table->text('missing_equip_remarks')->nullable()->default(null);
            $table->text('damage_remarks')->nullable()->default(null);
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
            $table->integer('status_id')->unsigned()->nullable()->default(null);
            $table->foreign('status_id')->references('id')->on('inventory_status')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->dropColumn('availability_status_id');
            $table->dropColumn('equipment_status_id');
        });
        Schema::drop('availability_status');
        Schema::drop('equipment_status');
        Schema::table('reservations', function(Blueprint $table) {
            $table->integer('camera_count_checkout');
            $table->boolean('reserved_camera_yn');
            $table->string('missing_equip', 500);
            $table->dropColumn('missing_equip_yn');
            $table->dropColumn('missing_equip_remarks');
            $table->dropColumn('damage_remarks');
        });
    }
}
