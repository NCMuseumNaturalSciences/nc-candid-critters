<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReviseDeploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deployments', function(Blueprint $table) {
            $table->dropColumn('data_uploaded_yn');
            $table->dropColumn('deployment_made_yn');
            $table->dropColumn('deployment_removed_yn');
            $table->dropColumn('uploaded_yn');
            $table->string('upload_status')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deployments', function(Blueprint $table) {
            $table->boolean('data_uploaded_yn')->default(0);
            $table->boolean('deployment_made_yn')->default(0);
            $table->boolean('deployment_removed_yn')->default(0);
            $table->boolean('uploaded_yn')->default(0);
            $table->dropColumn('upload_status');
        });
    }
}
