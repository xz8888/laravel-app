<?php

use Symfony\Component\Console\Tester\CommandTester;

class StatCommandTest extends TestCase {
	
	
    public function setUp(){
    	//setup the parent
    	parent::setUp();

    	//seed the application
 
    	$this->prepareForTests();
    }

	public function tearDown(){
		
	}

    public function testUpdateStatSuccessfully(){
        $command = new StatsCommand();
        
        $tester = new CommandTester($command);
        $tester->execute(array('date' => '2012-03-01'));

        //getting the result for this dat
        $data = Stat::where('date', '2012-03-01')->first();

        if(empty($data))
        	$this->assertTrue('false', 'data on the date specified cant be found');
        else{
        	$this->assertEquals(1, $data->sent_num);
        	$this->assertEquals(1, $data->co_num);
        	$this->assertEquals(0, $data->fn_num);
        	$this->assertEquals(0, $data->me_num);
        	$this->assertEquals(0, $data->mes_num);
        	$this->assertEquals(0, $data->mer_num);
        	$this->assertEquals(0, $data->pr_num);

        }
    }

    public function testUpdateNotFound(){
    	$command = new StatsCommand();
        
        $tester = new CommandTester($command);

        //getting the result for this dat
        $data = Stat::where('date', '2012-03-02')->first();

        $this->assertTrue(empty($data));

        $tester->execute(array('date' => '2012-03-02'));
        $data = Stat::where('date', '2012-03-02')->first();

        $this->assertTrue(!empty($data));

        $this->assertEquals(0, $data->sent_num);
        $this->assertEquals(0, $data->co_num);
        $this->assertEquals(1, $data->fn_num);
        $this->assertEquals(1, $data->me_num);
        $this->assertEquals(0, $data->mes_num);
        $this->assertEquals(0, $data->mer_num);
        $this->assertEquals(0, $data->pr_num);


    }

}