<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Book extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id('idBook');
            $table->string('bookTitle');
            $table->unsignedBigInteger('category');
            $table->foreign('category')->references('idCategory')->on('category');
            $table->date('publicationDate');
            $table->unsignedBigInteger('author');
            $table->foreign('author')->references('idAuthor')->on('author');
            $table->string('language');
            $table->integer('quantity');
            $table->unsignedBigInteger('idShelf');
            $table->foreign('idShelf')->references('idShelf')->on('shelf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
