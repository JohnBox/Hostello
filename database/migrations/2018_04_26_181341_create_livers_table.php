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
            $table->boolean('is_student');
            $table->integer('group_id')->nullable();
            $table->float('balance')->default(0.0);
            $table->string('doc_number');
            $table->string('phone');
            $table->integer('room_id')->nullable();
            $table->boolean('is_active')->nullable();
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
