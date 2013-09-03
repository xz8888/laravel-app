<?php

class Application extends Eloquent {

	protected $table = 'applications';
     
    protected $guarded = array();

    public static $rules = array();

    public function calculateWaitTime(){
        $application_filed = $this->sent;
        $cash_out = $this->co;
        $file_number = $this->fn;
        $me = $this->me;
        $mes = $this->mes;
        $mer = $this->mer;
        $pr = $this->pr;

        $wait = $this->waitTime(array($application_filed, $cash_out, $file_number, $me, $mes, $mer, $pr));

        $this->wait1 = $wait[1];
        $this->wait2 = $wait[2];
        $this->wait3 = $wait[3];
        $this->wait4 = $wait[4];
        $this->wait5 = $wait[5];
        $this->wait6 = $wait[6];
      
        $this->total_wait_time = $this->calculateInterval($application_filed, $pr);
    }

	private function calculateInterval($date1, $date2){
        if ($date1 != '0000-00-00' && $date1 != '1970-01-01' && $date2 != '0000-00-00' && $date2 != '1970-01-01'){
            $datediff = strtotime($date2) - strtotime($date1);
            return intval(floor($datediff/(60 * 60 * 24)));     
        }
        else
            return 0;
    }

    public static function getApplicationsByUser($user_id){
        $applications = Application::where('user_id', '=', $user_id)->get();

        return $applications;
    }

    /**
     * Calculate wait time
     */
    public function waitTime($stats){

     
      $wait = array();
      foreach($stats as $index => $stat){
          if($index > 0){
             if($stat == '0000-00-00'  || $stat == '1970-01-01'){
                 $wait[$index] = 0;
             }
             else{
                //find the interval that is not equal to 0
                $wait[$index] = 0;
                for ($j = $index - 1; $j >= 0; $j--){

                   if($stats[$j] != 0){
                     $wait[$index] = $this->calculateInterval($stats[$j], $stat);
                     break;
                   }
                } 
             }
          }
      }

      return $wait;

    }

}