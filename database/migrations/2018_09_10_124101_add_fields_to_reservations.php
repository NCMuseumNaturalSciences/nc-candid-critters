<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function(Blueprint $table) {
           $table->string('librarian_name');
           $table->string('librarian_email');
           $table->string('librarian_phone')->nullable()->default(null);
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
            $table->dropColumn('librarian_name');
            $table->dropColumn('librarian_email');
            $table->dropColumn('librarian_phone');
        });
    }
}
