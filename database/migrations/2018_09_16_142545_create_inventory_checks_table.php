<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id')->unsigned();
            $table->boolean('camera_present_yn')->default(1);
            $table->boolean('plastic_box_yn')->default(1);
            $table->boolean('lock_yn')->default(1);
            $table->boolean('item_list_yn')->default(1);
            $table->boolean('batteries_yn')->default(1);
            $table->boolean('sd_cards_yn')->default(1);
            $table->boolean('camera_working_yn')->default(1);
            $table->string('checked_by_name',255)->nullable()->default(null);
            $table->string('checked_by_email',255)->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory_checks');
    }
}
