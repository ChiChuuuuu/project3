<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shelf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelf', function (Blueprint $table) {
            $table->id('idShelf');
            $table->string('shelfNo');
            $table->string('floorNo');
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('idStatus')->on('shelf_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelf');
    }
}
