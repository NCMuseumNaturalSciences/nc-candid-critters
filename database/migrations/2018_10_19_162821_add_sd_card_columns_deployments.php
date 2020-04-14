<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSdCardColumnsDeployments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deployments', function(Blueprint $table)
        {
            $table->string('sent_sd_card_id')->nullable()->default(null);
            $table->string('returned_sd_card_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deployments', function(Blueprint $table)
        {
            $table->dropColumn('sent_sd_card_id');
            $table->dropColumn('returned_sd_card_id');
        });
    }
}
