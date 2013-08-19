<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TimeCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'time:collect';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
	    $numberOfMonths = $this->argument('month');
	    if(empty($numberOfMonths))
	    	$numberOfMonths = 12;
	    $start_date = date('Y-m-d H:i:s', strtotime('-'.$numberOfMonths.' months'));

        $this->info('display the number of months '.$numberOfMonths);
        $this->collect_data($start_date, 'cec');
        $this->collect_data($start_date, 'pnp');
        $this->collect_data($start_date, 'fsw');
        $this->collect_data($start_date, 'marriage');
	}

    /** collect the current data **/

	public function collect_data($start_date, $type = 'cec'){
       //walk through the table
	   $results = DB::select('SELECT * FROM applications WHERE updated_at >= ? and type = ?', array($start_date, $type));

	   $this->info('Total number of data processed'.sizeof($results));

       $total_wait1 = 0;
       $total_wait2 = 0;
       $total_wait3 = 0;
       $total_wait4 = 0;
       $total_wait5 = 0;
       $total_wait6 = 0;
       $total_wait_time = 0;

       $wait1_count = 0;
       $wait2_count = 0;
       $wait3_count = 0;
       $wait4_count = 0;
       $wait5_count = 0;
       $wait6_count = 0;
       $wait_total = 0;

	   foreach($results as $result){
           if($result->wait1 > 0){
           	 $total_wait1 += $result->wait1;
           	 $wait1_count++;
           }

           if($result->wait2 > 0){
           	 $total_wait2 += $result->wait2;
           	 $wait2_count++;
           }
           
           if($result->wait3 > 0){
           	 $total_wait3 += $result->wait3;
           	 $wait3_count++;
           }

           if($result->wait4 > 0){
           	 $total_wait4 += $result->wait4;
           	 $wait4_count++;
           }
           
           if($result->wait5 > 0){
           	 $total_wait5 += $result->wait5;
           	 $wait5_count++;
           }
           
           if($result->wait6 > 0){
           	 $total_wait6 += $result->wait6;
           	 $wait6_count++;
           }
           
           if($result->total_wait_time > 0){
           	 $total_wait_time += $result->total_wait_time;
           	 $wait_total++;
           }
	   }

       echo $total_wait1;
	   //calculate the average wait time
	   $average_wait1 = $wait1_count == 0 ? 0 : round($total_wait1 / $wait1_count);
       $average_wait2 = $wait2_count == 0 ? 0 : round($total_wait2 / $wait2_count);
       $average_wait3 = $wait3_count == 0 ? 0 : round($total_wait3 / $wait3_count);
       $average_wait4 = $wait4_count == 0 ? 0 : round($total_wait4 / $wait4_count);
       $average_wait5 = $wait5_count == 0 ? 0 : round($total_wait5 / $wait5_count);
       $average_wait6 = $wait6_count == 0 ? 0 : round($total_wait6 / $wait6_count);

       //calculate the average total data
       $average_total_wait_time = $wait_total == 0 ? 0 : round($total_wait_time / $wait_total);

       //insert the data record
       $result = DB::insert('INSERT INTO time_stats (cash_out_time, fn_time, medical_exam_request_time, medical_sent_time, medical_receive_time, pr_time, total_wait_time, `date`, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', array($average_wait1, $average_wait2, $average_wait3, 
       	    $average_wait4, $average_wait5, $average_wait6, $average_total_wait_time, date('Y-m-d'), $type));

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('month', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}