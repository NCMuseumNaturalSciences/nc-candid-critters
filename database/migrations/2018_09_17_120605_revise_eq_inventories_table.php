<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviseEqInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function(Blueprint $table) {
            $table->dropColumn('eq_batteries_yn');
            $table->dropColumn('eq_lock_yn');
            $table->dropColumn('eq_sd_cards_yn');
            $table->dropColumn('eq_camera_working_yn');
            $table->dropColumn('batteries_yn_str');
            $table->dropColumn('lock_yn_str');
            $table->dropColumn('sd_cards_yn_str');
            $table->dropColumn('camera_working_yn_str');
            $table->dropColumn('eq_camera_missing_yn');
            $table->dropColumn('eq_check_remarks');
            $table->dropColumn('camera_missing_yn_str');
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
            $table->boolean('eq_batteries_yn')->default(0);
            $table->boolean('eq_lock_yn')->default(0);
            $table->boolean('eq_sd_cards_yn')->default(0);
            $table->boolean('eq_camera_working_yn')->default(0);
            $table->string('batteries_yn_str')->default('Yes');
            $table->string('lock_yn_str')->default('Yes');
            $table->string('sd_cards_yn_str')->default('Yes');
            $table->string('camera_working_yn_str')->default('Yes');
            $table->boolean('eq_camera_missing_yn')->default(0);
            $table->text('eq_check_remarks')->nullable()->default(null);
            $table->string('camera_missing_yn_str')->default('No');
        });
    }
}
