<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiverViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liver_violation', function (Blueprint $table) {
            $table->integer('liver_id')->unsigned();
            $table->foreign('liver_id')->references('id')->on('livers');
            $table->integer('violation_id')->unsigned();
            $table->foreign('violation_id')->references('id')->on('violations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liver_violation');
    }
}
