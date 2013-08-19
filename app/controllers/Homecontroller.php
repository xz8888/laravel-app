<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function index()
	{
		//grabbing the time stats
	    $time_stats =  DB::table('time_stats')->where('date', date('Y-m-d'))->get();

	    //getting the lastest 10 questions
	    $questions = Question::latest();

	    //getting the total number of questions
	    $total_num_questions = DB::select("SELECT COUNT(*) as total from posts WHERE post_type_id = ?", array(Post::$types['Question']));
  
        //getting the stats for current month
        $current_month = date('n');
        $stats = DB::select("SELECT SUM(sent_num) as sent_total, SUM(co_num) as cash_out_total, SUM(me_num) as me_total, SUM(pr_num) as pr_total FROM stats WHERE date = ?", array(date('Y-m-d')));

        $stats = get_object_vars($stats[0]);
        foreach($stats as $i => $sta){
           if(!$sta)
           	   $stats[$i] = 0;
        }

     	return View::make('home.index', array('time_stats' => $time_stats, 'stats' => $stats,'questions' => $questions, 'total_questions' => $total_num_questions[0]->total));
	}
	
	public function message(){
		return View::make('home.message');
	}

}