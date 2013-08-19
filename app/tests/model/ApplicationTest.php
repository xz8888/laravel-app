<?php

class ApplicationTest extends TestCase{

	 public function setUp(){
    	//setup the parent
    	parent::setUp();

    	//seed the application
 
    	$this->prepareForTests();
    }

	public function tearDown(){
		
	}

    /** test the wait time **/
	public function testWaitTime(){
        $application = new Application;

        $testDate1 = array('2012-01-01','2012-01-02','2012-01-03','2012-01-04','2012-01-05','2012-01-06', '2012-01-07');
        $resultDate1 = array(1 => 1, 2 => 1, 3 => 1, 4=> 1, 5=> 1, 6 => 1);

        $testDate2 = array('2012-01-01', '0000-00-00', '2012-01-03', '2012-01-04', '2012-01-05', '2012-01-06', '2012-01-07');
        $resultDate2 = array(1 => 0, 2=> 2, 3 => 1, 4 => 1, 5=> 1, 6 => 1);

        $testDate3 = array('2012-01-01', '0000-00-00', '0000-00-00', '2012-01-03', '2012-01-04', '2012-01-05', '2012-01-06');
	    $resultDate3 = array(1 => 0, 2 => 0, 3 =>  2, 4=> 1, 5 => 1, 6 => 1);

        $testDate4 = array('2012-01-01', '0000-00-00', '0000-00-00', '0000-00-00',  '2012-01-03', '2012-01-05', '2012-01-08');
	    $resultDate4 = array(1 => 0, 2 =>  0, 3 => 0, 4 => 2, 5 => 2, 6 => 3);
        
        $calculatedArray =  $application->waitTime($testDate1);

	    $this->assertEquals($resultDate1,$calculatedArray);
	    $this->assertEquals($resultDate2, $application->waitTime($testDate2));
	    $this->assertEquals($resultDate3, $application->waitTime($testDate3));
	    $this->assertEquals($resultDate4, $application->waitTime($testDate4));

	}
}