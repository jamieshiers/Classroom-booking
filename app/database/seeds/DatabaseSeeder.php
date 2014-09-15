<?php

class DatabaseSeeder extends Seeder {

	public function run()
	{

        if (App::environment() === 'Production' )
        {
            exit('Just stopped you reseeding the production database');
        }

		Eloquent::unguard();

        $tables = [
        'rooms'
        ];

        foreach($tables as $table)
        {
            DB::table($table)->truncate();
        }

        $this->call('RoomsTableSeeder');

	}

}
