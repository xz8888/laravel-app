<?php

/** seeder file for posters **/
class PostTypeTableSeeder extends seeder{

	public function run(){

		DB::table('post_types')->delete();
		PostType::create(array('name' => 'Question'));

		PostType::create(array('name' => 'Documents'));

	}


}