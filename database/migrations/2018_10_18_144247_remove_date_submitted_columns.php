<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDateSubmittedColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signups', function(Blueprint $table) {
            $table->dropColumn('date_submitted');
        });
        Schema::table('site_descriptions', function(Blueprint $table) {
            $table->dropColumn('date_submitted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signups', function(Blueprint $table) {
            $table->date('date_submitted')->nullable()->default(null);
        });
        Schema::table('site_descriptions', function(Blueprint $table) {
            $table->date('date_submitted')->nullable()->default(null);
        });
    }
}
