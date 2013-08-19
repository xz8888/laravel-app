<?php

use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
    if(!Schema::hasTable('stats')){
          //weekly stats
  		Schema::create('stats', function($t){
       
             $t->increments('id');
             
             $t->integer('sent_num');
             $t->integer('co_num');
             $t->integer('fn_num');
             $t->integer('me_num');
             $t->integer('mes_num');
             $t->integer('mer_num');
             $t->integer('pr_num');
             
             $t->smallInteger('year');
             $t->smallInteger('month');
             $t->smallInteger('day');

             $t->date('date');
             $t->dateTime('created_at');
             $t->dateTime('updated_at');

             $t->index(array('year', 'month', 'day'));
             $t->unique('date');
  		});
    }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}