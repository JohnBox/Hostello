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
            $table->string('second_name');
            $table->date('birth_date');
            $table->boolean('gender');
            $table->boolean('student');
            $table->float('balance');
            $table->date('injected')->nullable();
            $table->date('ejected')->nullable();
            $table->integer('room_id')->nullable();
            $table->integer('group_id');
            $table->integer('user_id');
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
