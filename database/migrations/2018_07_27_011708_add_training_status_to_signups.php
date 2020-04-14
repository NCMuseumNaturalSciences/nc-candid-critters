<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingStatusToSignups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signups', function(Blueprint $table)
        {
            $table->dropColumn('training_complete_yn');
            $table->dropColumn('training_assigned_yn');
            $table->integer('training_status_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signups', function(Blueprint $table)
        {
            $table->dropColumn('training_status_id');
        });

    }
}
