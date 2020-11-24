<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentresults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->integer('form_id')->unsigned();
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('form_type')->nullable();
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('student_school_id')->nullable();
            $table->decimal('average_point', 6,2)->nullable();
            $table->decimal('sum_coff', 6,2)->nullable();
            $table->decimal('stud_ave', 6,2)->nullable();
            $table->integer('position')->nullable();
            $table->integer('class_position')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('studentresults');
    }
}
