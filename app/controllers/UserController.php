<?php
use Sentry\Sentry_User;

class User_Controller extends Base_Controller{
	
	public function action_index(){

	}
	
	public function action_login(){
		
		if(Request::method() == 'POST'){
			try {
				$input = self::trim();
				$rules = array(
						'email'	=>	'required|email|max:100',
						'password'	=>	'required'
				);
			
				$validation = Validator::make($input,$rules);
				if($validation->fails()) {
					return Redirect::to("user/login")
					->with_input()
					->with_errors($validation);
				}
			
				// log the user in
				$valid_login = Sentry::login($input['email'], $input['password'], true);
			
				if ($valid_login) {
					if(Session::has('redirect_url')){
						$url = Session::get('redirect_url');
						Session::forget('redirect_url');
						return Redirect::to($url);
					}
					else
						return Redirect::to("/");
				}
				else{
					Session::flash('messages', array(Lang::line('user.invalid_login')));
					return Redirect::to('user/login');
				}
			}
			
			catch (Sentry\SentryException $e) {
				// issue logging in via Sentry - lets catch the sentry error thrown
				// store/set and display caught exceptions such as a suspended user with limit attempts feature.
				$errors = new stdClass();
				$errors->messages = array(array($e->getMessage()));
				return Redirect::to("user/login")
				->with_input()
				->with_errors($errors);
			}
		}
		
		return View::make('users.login');
	}
	
	/**
	 * Edit the user profile
	 */
	public function action_edit(){

		return View::make('users.edit');	
	}
	
	/**
	 * Default my home page
	 */
	public function get_my(){
		
		return View::make('users.my');
	}
	
	/**
	 * Defines the welcome page 
	 */
	public function get_welcome(){
		
	}
	
	public function get_activate() {
		try {
			$email = filter_var(urldecode(Input::get('email')), 'FILTER_SANTITIZE_EMAIL');
			$hash = filter_var(urldecode(Input::get('hash')), 'FILTER_SANITIZE_STRING');
			
			$user = Sentry::user($email);
			if ($user['passwords']['activation_hash'] == $hash) {
				$update = $user->update(array(
						'activated' => 1,
				));
				if ($update) {
					Sentry::force_login($email);
					Session::flash("messages",array(Lang::line('user.activiate success')));
					return Redirect::to("user/welcome");
				}
				else {
					// something went wrong
					throw new Sentry\SentryException("Activation error.");
				}
			}
			else {
				// die(var_dump($activate_user));
				throw new Sentry\SentryException("Activation error.");
			}
		}
		catch (Sentry\SentryException $e) {
			$errors = new stdClass();
			$errors->messages = array(array($e->getMessage()));
			return Redirect::to('user/register')
			->with_errors($errors);
		}
	}
	
	
	public function action_register(){

		/** handle user register **/
	    if(Request::method() == 'POST'){

	    	//Perform validation first
	    	try {
	    		//trim the inputs
	    		$input = self::trim();
                
	    		//santitize the username
	    		$input['username'] = filter_var($input['username'], FILTER_SANITIZE_STRING);
	    		$rules = array(
	    				'username'	=>	'required|unique:users|max:100',
	    				'email'		=>	'required|email|unique:users|max:100',
	    				'password'	=>	'required|between:6,16',
	    				'password2'	=>	'required|between:6,16|same:password',
	    		);

	    		$validation = Validator::make($input,$rules);
	    		if($validation->fails()) {
	    			return Redirect::to("user/register")
	    			->with_input()
	    			->with_errors($validation);
	    		}
	    		// create the user
	    		$user = Sentry::user()->register(array(
	    				'username' => $input['username'],
	    				'email' => $input['email'],
	    				'password' => $input['password'],
	    				'metadata' => array(
	    						'city' => $input['city']

	    				)
	    		));
	    		
	    		if ($user) {
	    	
	    			if(Request::env() != 'dev'){
	    				
	    				$email = urlencode($input['email']);
	    				$user = Sentry::user($user['id']);
	    					
	    				$hash = urlencode($user['passwords']['activation_hash']);
	    				// send email with link to activate, only works with none local environment.
	    	
	    				$body =	View::make("Users::users.activationemail",array(
	    						'name'	=> $user->username,
	    						'link'	=> URL::to("/user/activiate")."?email=$email&hash=$hash",
	    						'title'	=> Lang::line('user.activiate'),
	    						'phone'	=> '1-888-544-3062',
	    						'address'	=>	Lang::line('common.address'),
	    				))->render();
	    				$message = Message::to($input['email'])
	    				->from(Config::get('application.juzi_config.contact_address'), Lang::line('common.title'))
	    				->subject('Your BreezeStreet.com Activation.')
	    				->body($body)
	    				->html(true)
	    				->send();
	    			}
	    	
	    			//add the user group
	    			$sentry_user = Sentry::user($user['id']);
	    			$sentry_user->add_to_group(2);
	    			
	    			Session::flash("messages",array(Lang::line('user.activiate code')));
	    			 
	    			return Redirect::to("home/message");
	    		}
	    	}
	    	catch (Sentry\SentryException $e) {
	    		$errors = new stdClass();
	    		$errors->messages = array(array($e->getMessage()));
	    		return Redirect::to("user/register")
	    		->with_input()
	    		->with_errors($errors);
	    	}
	    }
	    
		return View::make('users.register');
	}
	
	//Logout handler.
	public function action_logout()	{
		Sentry::logout();
		Session::flush();
		return Redirect::to('user/login');
	}
}