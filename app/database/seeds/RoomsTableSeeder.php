<?php

use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Rooms::create([
                'RoomName'      => $faker->firstName,
                'RoomType'      => 'classroom',
                'BookingType'   => 'fixed',
                'Active'        => $faker->boolean(85),
			]);
		}
	}

}