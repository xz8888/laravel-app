<?php

/**
 *
 * Handle all admin related functions
 */
class AdminController extends BaseController{
	
    protected $default_date = '0000-00-00';
    protected $default_type = 'pnp';
    protected $default_office = 'buffalo';
    protected $default_transfer = 'ottawa';


    public function __construct(){
		
		parent::__construct();
	}
		//add the filter 
    
    public function index(){

    	return View::make('admin.index');
    }

    /** question plugin **/
	public function questions(){
       
       $questions = Question::orderBy('created_at', 'DESC')->paginate(20);
       
       return View::make('admin.questions', array('questions' => $questions));
	}

	/**
	 * manage the applications
	 */

	public function applications(){
       
        $applications = Application::orderBy('created_at', 'DESC')->paginate(20);
    
        return View::make('admin.applications', array('applications' => $applications));
	}
    
    /** create a new application **/
    public function applications_add(){
       
       return View::make('admin.applications_add');
    }

    /** delete an application **/
    public function applications_delete($id){
        $application = Application::find($id);

        if($application->delete())
            return Redirect::to('/admin/applications');
       
    }
    
    /** create the applications **/
    public function applications_create(){
        $inputs = Input::all();
        $inputs = array_map('trim', $inputs);

         //check for validation
         $rules = array(
            'sent' =>  'required|date',
            'type' =>  'required'
        );

         $messages = array(
            'sent.required' => Lang::get('immigration.sent_required'), 
            'type.required' => Lang::get('immigration.type_required')
         );
            
        $validation = Validator::make($inputs,$rules, $messages);

        if($validation->fails()) {
            return Redirect::refresh()
                ->withInput()
                ->withErrors($validation);
        }
         
         $application = new Application();

         $application->sent = empty($inputs['sent']) ? $this->default_date : $inputs['sent'];
         $application->co = empty($inputs['co']) ? $this->default_date : $inputs['co'];
         $application->fn = empty($inputs['fn']) ? $this->default_date : $inputs['fn'];
         $application->me = empty($inputs['me']) ? $this->default_date : $inputs['me'];
         $application->mes = empty($inputs['mes']) ? $this->default_date : $inputs['mes'];
         $application->mer = empty($inputs['mer']) ? $this->default_date : $inputs['mer'];
         $application->pr = empty($inputs['pr']) ? $this->default_date : $inputs['pr'];

         $application->type = empty($inputs['type']) ? 'cec' : $inputs['type'];
         $application->office = empty($inputs['office']) ? 'buffalo' : $inputs['office'];
         $application->transfer = empty($inputs['transfer']) ? 'ottawa' : $inputs['transfer'];
         $application->comment = Purifier::clean($inputs['comment']);

         $user = $this->generateUser($inputs['username']);
         $application->user_id = $user->id;

         //calculate the wait time
         $application->calculateWaitTime();

         //save the application
         $theApplication = $application->save();

         if($theApplication)
            return Redirect::to('/admin/applications')->with('messages', array(Lang::get('immigration.creation success')));
         else
            return Redirect::to('/admin/applications')->with('error_messages', array(Lang::get('immigration.creation error')));

    }


	public function questions_add(){
		return View::make('admin.questions_add');
	}

	/** remove the question **/
	public function questions_delete($id){
    
        $question = Question::find($id);

        if($question->delete())
        	return Redirect::to('/admin/questions');
	}
    
    /** add the question **/
	public function questions_create(){
		$inputs = Input::all();
        $inputs = array_map('trim', $inputs);
        $rules = array(
           'title' => 'required|min:3'
        );

        $validations = Validator::make($inputs, $rules);
        if($validations->fails())
            return Redirect::to('question-create')->withInput()
                                      ->withErrors($validations);
	    
        $user_name = $inputs['username'];
        $title = $inputs['title'];
        $content = $inputs['content'];

        $user = $this->generateUser($user_name);

        $question = new Question();
        $question->title = $title;
        $question->body = $content; 

        //may need a database query to retrieve the type id in the future
        $question->post_type_id = self::TYPE_QUESTION;
        $question->parent_id = 0;
        $question->user_id = $user->id;
        $question->owner_display_name = $user->username;
       
        if($question->save()){
            return Redirect::to('/admin/questions')->with('message', Lang::get('question.success'));
        }

	}

    private function generateUser($username){
//getting the total number of users
        $results = DB::select("SELECT COUNT(*) as total_users FROM users");
        $total_user = $results[0]->total_users;

        //see if user exists, if not, create one
        $user = Sentry::createUser(array(
            'email' => 'robot'.$total_user.'@juzi.ca',
            'username' => $username,
            'password' => 'juzi1234'
        ));

        $userGroup = Sentry::getGroupProvider()->findByName('Users');
        $user->addGroup($userGroup);

        return $user;
    }
		
}