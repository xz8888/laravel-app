<?php

use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//creat the question table
        Schema::create('posts', function($table){
          
        $table->increments('id');
        $table->smallInteger('post_type_id');
        $table->integer('accepted_answer_id');
        $table->integer('parent_id');
        $table->dateTime('created_at');
        $table->decimal('score', 5,2);
        $table->integer('viewCount');

        //actual content
        $table->string('title');
        $table->text('body');
        
        //owner
        $table->integer('user_id');
        $table->string('owner_display_name');
        $table->integer('last_editor_user_id');
        $table->string('last_editor_user_name');
        $table->integer('answer_count')->default(0);
        $table->integer('comment_count')->default(0);
        $table->string('tags');

        //rest
        $table->dateTime('last_activity');
        $table->boolean('closed')->default(0);
        $table->boolean('pending')->default(0);
        $table->dateTime('closed_date');

        });

        Schema::create('post_types', function($table){

        	$table->increments('id');
            $table->text('name');
        });

        Schema::create('tags', function($table){

           $table->increments('id');
           $table->string('tag_name');
           $table->integer('count');

        });
		//create the posts table
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