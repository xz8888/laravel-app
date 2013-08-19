<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Stats command runs daily to update the stats
 */
class StatsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'stats:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate the daily stats report';

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
		// $date = date('Y-m-d');
		// $this->updateStats();
		$date = $this->argument('date');

		if(!$date)
			$date = date('Y-m-d');

		$this->updateStats($date);

	}

    /*
     *  udpate the stats
     */
    protected function updateStats($date){
        //retrieve all applications created today
		$data_types = array('sent', 'co', 'fn', 'me', 'mes', 'mer', 'pr');
		$data_result = array();
		foreach($data_types as $type){
			$total = $this->getTotal($type, $date);
		     
            $data_result[$type] = intval($total);
		}

		//search if the stats exist for today. if yes, update it, otherwise. update it
		$data = DB::table('stats')->where('date', $date)->first();
        
        $result_array['sent_num'] = $data_result['sent'];
        $result_array['co_num'] = $data_result['co'];
        $result_array['fn_num'] = $data_result['fn'];
        $result_array['me_num'] = $data_result['me'];
        $result_array['mes_num'] = $data_result['mes'];
        $result_array['mer_num'] = $data_result['mer'];
        $result_array['pr_num']  =  $data_result['pr'];
        $result_array['created_at'] = date('Y-m-d h:i:s');
        $result_array['updated_at'] = date('Y-m-d h:i:s');

        
        if(empty($data)){
           $result_array['date'] = $date;
           $result_array['year'] = date('Y', strtotime($date));
           $result_array['month'] = date('m', strtotime($date));
           $result_array['day'] = date('d', strtotime($date));

           DB::table('stats')->insertGetId($result_array);
        }
        else
          DB::table('stats')->where('id', $data->id)
                            ->update($result_array);
    }

    private function getTotal($type = 'sent', $date){
    	$result = DB::select('SELECT COUNT(id) as total FROM applications where `'.$type.'` = ?', array($date));
        
        return $result[0]-> total;
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('date', InputArgument::OPTIONAL, 'An example argument.'),
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