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
        //$this->command->info('Group table Seeded'); 
	    $this->call('UserTableSeeder');
	    //$this->command->info('User table seeded!');
		$this->call('PostTypeTableSeeder');
		//$this->command->info('Post type table seeded!');
		$this->call('ApplicationTableSeeder');
		//$this->command->info('Application table seeded!');
		$this->call('StatTableSeeder');
		//$this->command->info('Stats table seeded!');
	}

}