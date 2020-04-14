<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFieldsFromReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropColumn('checkout_length');
            $table->dropColumn('reservation_date');
            $table->dropColumn('return_date');
            $table->dropColumn('overdue_yn');
            $table->dropColumn('uploaded_yn');
            $table->dropColumn('pictures_drive_yn');
            $table->dropColumn('equip_damage_yn');
            $table->dropColumn('reservation_closed_yn');
            $table->dropColumn('missing_equip_yn');
            $table->dropColumn('missing_equip_remarks');
            $table->dropColumn('damage_remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
