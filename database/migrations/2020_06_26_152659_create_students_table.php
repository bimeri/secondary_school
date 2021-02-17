<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('school_id')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('password');
            $table->string('date_enrolled');
            $table->string('lang')->default('en');
            $table->boolean('suspend')->default(0);
            $table->boolean('dismissed')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
