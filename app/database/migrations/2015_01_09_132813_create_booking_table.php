<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('roomId');
            $table->integer('periodId');
            $table->string('username');
            $table->string('class');
            $table->string('lesson');
            $table->date('startDate');
            $table->date('endDate');
            $table->boolean('block');
            $table->integer('weekNum');
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
		Schema::drop('booking');
	}

}
