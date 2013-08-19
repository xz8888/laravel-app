<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('users')->delete();
        DB::table('users_groups')->delete();
        
		$user = Sentry::getUserProvider()->create(array(
			'email' => 'sean.zheng.xiao@gmail.com',
			'password' => 'test'
		));

		$adminGroup = Sentry::getGroupProvider()->findByName('Administrator');

		$user->addGroup($adminGroup);
	}

}