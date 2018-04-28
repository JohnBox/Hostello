<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('liver_id');
            $table->date('date');
            $table->float('live_price');
            $table->float('gas_price');
            $table->float('elec_price')->nullable();
            $table->float('water_price')->nullable();
            $table->float('total');
            $table->float('paid')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
