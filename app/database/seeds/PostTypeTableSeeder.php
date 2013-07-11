<?php

/** seeder file for posters **/
class PostTypeTableSeeder extends seeder{

	public function run(){
		PostType::create(array('name' => 'Question'));

		PostType::create(array('name' => 'Documents'));

	}


}