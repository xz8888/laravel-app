<?php

class ApplicationTableSeeder extends Seeder{

    /** run the application **/
	public function run(){

        DB::table('applications')->delete();

		Application::create(
			array(
                'user_id' => 2, 
                'type' => 'pnp', 
                'title' => 'test',
                'sent' => '2012-03-01', 
                'co' => '2012-03-01',
                'fn' => '2012-03-02',
                'me' => '2012-03-02',
                'mes' => '2012-03-03',
                'mer' => '2012-03-03',
                'pr'  => '20102-03-04',
                'office' => 'ottawa',
                'comment' => ''
			));  

		

	}
}