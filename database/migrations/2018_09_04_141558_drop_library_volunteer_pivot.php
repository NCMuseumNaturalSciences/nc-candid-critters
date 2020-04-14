<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLibraryVolunteerPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('library_volunteer');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('library_volunteer', function(Blueprint $table)
        {
            $table->integer('library_id')->unsigned()->index();
            $table->integer('volunteer_id')->unsigned()->index();
            $table->primary(['library_id','volunteer_id']);
        });
    }
}
