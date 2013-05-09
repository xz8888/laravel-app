<?php

class GroupTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Sentry::getGroupProvider()->create(array(
           'name' => 'Administrator',
           'permissions' => array(
               'superuser' => 1,
               'admin' => 1,
               'users' => 1
           	)
		));

		Sentry::getGroupProvider()->create(array(
           'name' => 'Users',
           'permissions' => array(
               'users' => 1
           	)
		));
	}

}