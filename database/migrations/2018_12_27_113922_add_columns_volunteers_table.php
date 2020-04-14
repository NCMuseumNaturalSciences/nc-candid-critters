<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteers', function(Blueprint $table) {
            $table->boolean('koozie_form_sent_yn')->default(0);
            $table->boolean('tshirt_form_sent_yn')->default(0);
            $table->boolean('tshirt_sent_yn')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteers', function(Blueprint $table) {
            $table->dropColumn('koozie_form_sent_yn');
            $table->dropColumn('tshirt_form_sent_yn');
            $table->dropColumn('tshirt_sent_yn');
        });

    }
}
