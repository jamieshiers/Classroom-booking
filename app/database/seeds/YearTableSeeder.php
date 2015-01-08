<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class YearTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Year::create([
                "startDate" => "2014-09-16 09:00:00",
                "endDate"   => "2015-07-01 09:00:00"
			]);
		}
	}

}