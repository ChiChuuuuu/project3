<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id('idStudent');
            $table->string('name');
            $table->date('dob');
            $table->boolean('gender');
            $table->string('department');
            $table->string('phone')->unique();
            $table->date('expiredDate');
            $table->unsignedBigInteger('idStatus');
            $table->foreign('idStatus')->references('idStatus')->on('student_status');
            $table->date('lastUpdated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
