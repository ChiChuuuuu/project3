<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BorrowedBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowed_book', function (Blueprint $table) {
            $table->id('idBB');
            $table->unsignedBigInteger('idBook');
            $table->unsignedBigInteger('idStudent');
            $table->foreign('idBook')->references('idBook')->on('book');
            $table->foreign('idStudent')->references('idStudent')->on('student');
            $table->date('fromDate');
            $table->date('toDate');
            $table->date('actualDate')->nullable();
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('staff');
            $table->boolean('status');
            $table->string('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowed_book');
    }
}
