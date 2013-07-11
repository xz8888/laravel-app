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
               'question.view' => 1,
               'question.update' => 1,
               'question.delete' => 1,
               'question.create' => 1
           	)
		));

		Sentry::getGroupProvider()->create(array(
           'name' => 'Users',
           'permissions' => array(
               'question.view' => 1,
               'question.update' => 1,
               'question.delete' => 1,
               'question.create' => 1
           	)
		));
	}

}