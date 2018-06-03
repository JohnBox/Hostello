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
            $table->foreign('liver_id')->references('id')->on('livers')
                ->onDelete('cascade');
            $table->integer('violation_id')->unsigned();
            $table->foreign('violation_id')->references('id')->on('violations')
                ->onDelete('cascade');
            $table->float('price');
            $table->date('paid')->nullable();
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
