<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SystemCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'system:run';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'System that runs various commands';

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
		//getting the arguments
		$value = $this->argument('action');
		 switch($arguments[0]){
             case 'import':
                $this->import();
                break;
             case 'amplify':
                $this->amplify();
                break;
             case 'waittime':
                $this->waittime();
                break;
         }

	}

	private function convertDate($date){
                if($date == 'N/A')
                        return '';
                else
                        return date('Y-m-d', strtotime($date));
    }

    private function amplify(){
                return true;
    }

   private function waitTime(){
       $applications = DB::select('SELECT * FROM applications ');
       
       foreach($applications as $app){
          $application_filed = $app->sent;
          $cash_out = $app->co;
          $file_number = $app->fn;
          $me = $app->me;
          $mes = $app->mes;
          $mer = $app->mer;
          $pr = $app->pr;
          
          $wait1 = $this->calculateInterval($application_filed, $cash_out);
          $wait2 = $this->calculateInterval($cash_out, $file_number);
          $wait3 = $this->calculateInterval($file_number, $me);
          $wait4 = $this->calculateInterval($me, $mes);
          $wait5 = $this->calculateInterval($mes, $mer);
          $wait6 = $this->calculateInterval($mer, $pr);
          $total_wait_time = $this->calculateInterval($application_filed, $pr);
          
          DB::query('UPDATE applications set wait1 = ?, wait2 = ?, 
                        wait3 = ?, wait4 = ?, wait5 = ?,  wait6 = ?, total_wait_time = ? WHERE id = '.$app->id, 
          array($wait1, $wait2, $wait3, $wait4, $wait5, $wait6, $total_wait_time));
    
        }
   }
    private function calculateInterval($date1, $date2){
        if ($date1 != '0000-00-00' && $date1 != '1970-01-01' && $date2 != '0000-00-00' && $date2 != '1970-01-01'){
            $datediff = strtotime($date2) - strtotime($date1);
            return floor($datediff/(60 * 60 * 24));     
        }
        else
            return 0;
    }
	
	/** import from the excel doc **/
	private function import(){
                Bundle::start('iapplication');
                
                $src = path('app').'\data\immigration.csv';
                $row = 0;
                if (($handle = fopen($src, 'r')) !== FALSE){
                
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
                                $row++;
                                if ($row == 1)
                                        continue;
                
                                if(count($data) == 11){
                                        $application_filed = $data[1];
                                        $application_filed = date('Y-m-d', strtotime($application_filed));
                                        $cash_out = $this->convertDate($data[2]);
                                        $file_number = $this->convertDate($data[3]);
                                        $me = $this->convertDate($data[4]);
                                        $mes = $this->convertDate($data[5]);
                                        $mer = $this->convertDate($data[6]);
                                        $office = $data[7];
                                        $transfer = $data[8];
                                        $pr = $this->convertDate($data[9]);
                                        $type = $data[10];
                
                                        //save the record
                                        ImmigrationApplication::create(array('user_id' => 0, 'type' => $type, 'genuine' => 1, 'amplified' => 0,
                                        'sent' => $application_filed, 'co' => $cash_out, 'fn' => $file_number, 'me' => $me,
                                        'mes' => $mes, 'mer' => $mer, 'office' => $office, 'transfer' => $transfer, 'pr' => $pr,
                                        ));
                                }
                        }
                }
                fclose($handle);
    }
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('action', InputArgument::REQUIRED, 'Import, Amplify, Waittime'),
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