<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviseInventoryReservationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropColumn('checkout_date');
            $table->dropColumn('checkin_date');
            $table->dropColumn('checked_in');
            $table->dropColumn('checked_in_yn');
            $table->date('open_date')->nullable()->default(null);
            $table->date('close_date')->nullable()->default(null);
            $table->boolean('closed_yn')->default(0);
            $table->text('close_remarks')->nullable()->default(null);
        });
        */
        Schema::table('inventories', function(Blueprint $table) {
            $table->dropColumn('equipment_remarks');
            $table->boolean('eq_camera_missing_yn')->default(0);
            $table->text('eq_check_remarks');
            $table->renameColumn('batteries_yn', 'eq_batteries_yn');
            $table->renameColumn('lock_yn', 'eq_lock_yn');
            $table->renameColumn('sd_cards_yn', 'eq_sd_cards_yn');
            $table->renameColumn('camera_yn', 'eq_camera_working_yn');
            $table->renameColumn('status', 'import_status_str');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function(Blueprint $table) {
            $table->date('checkout_date');
            $table->date('checkin_date');
            $table->string('checked_in');
            $table->boolean('checked_in_yn');
            $table->dropColumn('open_date')->nullable()->default(null);
            $table->dropColumn('close_date')->nullable()->default(null);
            $table->dropColumn('closed_yn')->default(0);
            $table->dropColumn('close_remarks')->nullable()->default(null);
        });
        Schema::table('inventories', function(Blueprint $table) {
            $table->text('equipment_remarks');
            $table->dropColumn('eq_camera_missing_yn')->default(0);
            $table->dropColumn('eq_check_remarks');
            $table->renameColumn('eq_batteries_yn', 'eq_batteries_yn');
            $table->renameColumn('eq_lock_yn', 'eq_lock_yn');
            $table->renameColumn('eq_sd_cards_yn', 'eq_sd_cards_yn');
            $table->renameColumn('eq_camera_working_yn', 'camera_yn');
            $table->renameColumn('import_status_str', 'status');
        });
    }
}
