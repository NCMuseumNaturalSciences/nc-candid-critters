<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviseInventoryYnToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('batteries_yn_str')->default('Yes');
            $table->string('lock_yn_str')->default('Yes');
            $table->string('sd_cards_yn_str')->default('Yes');
            $table->string('camera_yn_str')->default('Yes');
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
            $table->dropColumn('batteries_yn_str');
            $table->dropColumn('lock_yn_str');
            $table->dropColumn('sd_cards_yn_str');
            $table->dropColumn('camera_yn_str');
        });
    }
}
