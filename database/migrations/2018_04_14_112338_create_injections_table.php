<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInjectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injections', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('hostel_id')->unsigned();
            $table->foreign('hostel_id')->references('id')->on('hostels')
                ->onDelete('cascade');
            $table->integer('watchman_id')->unsigned();
            $table->foreign('watchman_id')->references('id')->on('watchmen')
                ->onDelete('cascade');
            $table->integer('liver_id')->unsigned();
            $table->foreign('liver_id')->references('id')->on('livers')
                ->onDelete('cascade');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade');
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
        Schema::dropIfExists('injections');
    }
}
