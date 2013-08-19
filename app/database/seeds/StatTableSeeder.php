<?php 

class StatTableSeeder extends Seeder{

	public function run(){

        DB::table('stats')->delete();

		Stat::create(
			array(
				'sent_num' => 0,
                'co_num'   => 1,
                'fn_num'   => 0,
                'me_num'   => 0, 
                'mes_num'  => 1,
                'mer_num'  => 0,
                'pr_num'   => 0,
                'year'     => '2013',                             
                'month'    => '03',
                'day'      => '01',
                'date'     => '2012-03-01'
			)); 

	}
}