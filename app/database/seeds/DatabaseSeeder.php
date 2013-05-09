<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

        //Create the group seed
        $this->call('GroupTableSeeder');
        $this->command->info('Group table Seeded'); 
	    $this->call('UserTableSeeder');
	    $this->command->info('User table seeded!');
	}

}