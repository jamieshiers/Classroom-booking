<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoildayName');
            $table->dateTimeTz('holidayStart');
            $table->dateTimeTz('hoildayEnd');
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
        schema::drop('hoilday');
    }
}
