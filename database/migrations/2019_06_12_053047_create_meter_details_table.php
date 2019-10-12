<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('meter_id');
            $table->boolean('status');
            $table->integer('pre_unit');
            $table->integer('curr_unit');
            $table->bigInteger('rate');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('meter_details');
    }
}
