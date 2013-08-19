<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_stats', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('cash_out_time');
			$table->integer('fn_time');
			$table->integer('medical_exam_request_time');
			$table->integer('medical_sent_time');
			$table->integer('medical_receive_time');
			$table->integer('pr_time');
			$table->integer('total_wait_time');
            $table->string('type');
            $table->date('date');
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('time_stats', function(Blueprint $table)
		{
			//
		});
	}

}