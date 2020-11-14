<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultcontrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultcontrols', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->integer('seq1_id')->unsigned();
            $table->foreign('seq1_id')->references('id')->on('sequences')->onDelete('cascade');
            $table->integer('seq2_id')->unsigned();
            $table->foreign('seq2_id')->references('id')->on('sequences')->onDelete('cascade');
            $table->integer('generateresult_id')->unsigned();
            $table->foreign('generateresult_id')->references('id')->on('generateresults')->onDelete('cascade');
            $table->boolean('status');
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
        Schema::dropIfExists('resultcontrols');
    }
}
