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
            $table->string('doc_number');
            $table->string('phone');
            $table->float('balance')->default(0);
            $table->boolean('bad_habit')->default(false);
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('groups')
                ->onDelete('set null');
            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('set null');
            $table->integer('hostel_id')->unsigned()->nullable(); //TODO: make not nullable
            $table->foreign('hostel_id')->references('id')->on('hostels')
                ->onDelete('set null');
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
        Schema::dropIfExists('livers');
    }
}
