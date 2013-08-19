      <?php

      use Illuminate\Database\Migrations\Migration;

      class CreateApplicationTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
          if(!Schema::hasTable('applications')){
            Schema::create('applications', function($t)
      	{
      		$t->increments('id');
      		$t->integer('user_id');
      		$t->string('type');
      		$t->string('title');

      		$t->dateTime('created_at');
      		$t->dateTime('updated_at');
                  $t->date('sent');

                  //cash out date
                  $t->date('co');
                  $t->date('fn');
                  //medical exam requested
                  $t->date('me');
                  //medical exam sent
                  $t->date('mes');
                  //medica exam requested
                  $t->date('mer');
                  //permanent residence
                  $t->date('pr');
                  //office
                  $t->string('office');
                  //transfer
                  $t->string('transfer');
                  //comment
                  $t->string('comment');
                  //wait time
                  $t->smallInteger('wait1');
                  //wait time
                  $t->smallInteger('wait2');
                  //wait time
                  $t->smallInteger('wait3');
                  //wait time
                  $t->smallInteger('wait4');
                  //wait time
                  $t->smallInteger('wait5');
                  //wait time
                  $t->smallInteger('wait6');
                  //total wait time
                  $t->smallInteger('total_wait_time');

                  $t->boolean('genuine');

                  $t->boolean('amplified');
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