<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('parent_name');
            $table->date('birth');
            $table->boolean('sex');
            $table->boolean('student');
            $table->integer('group_id');
            $table->string('country')->nullable();
            $table->string('canton')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('apart')->nullable();
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->string('which')->nullable();
            $table->string('when')->nullable();
            $table->string('tel1')->nullable();
            $table->string('tel2')->nullable();
            $table->string('tel3')->nullable();
            $table->integer('room_id')->nullable();
            $table->float('balance');
            $table->boolean('active')->default(true);
            $table->date('live_in')->nullable();
            $table->date('live_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livers');
    }
}
