<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;
class BookingTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Booking::create([
                'roomId'    => 1,
                'periodId'  => 1,
                'username'  => $faker->userName,
                'class'     => 'Year 9',
                'lesson'    => 'Art',
                'startDate' => Carbon::now(),
                'endDate'   => Carbon::now()->endOfWeek(),
                'block'     => 1,
                'weekNum'   => 1,
			]);
		}
	}

}