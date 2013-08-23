<?php

    class UserController extends BaseController{

    public function login(){

    	if(Request::getMethod() == 'POST'){
    		try {
             
                $inputs = Input::all();

    			$rules = array(
    					'email'	=>	'required|email|max:100',
    					'password'	=>	'required'
    			);
            
                //Trimmed inputs
                $inputs = array_map('trim', $inputs);

    			$validation = Validator::make($inputs,$rules);

    			if($validation->fails()) {
    				return Redirect::refresh()
    				->withInput()
    				->withErrors($validation);
    			}

                //authenticate the user
                try{

                	$credentials = array(
                       'email' => $inputs['email'],
                       'password' => $inputs['password']
                	);

                	$user = Sentry::authenticate($credentials, false);

                }
                catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }
               
                catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }

                // The following is only required if throttle is enabled
                catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
    			{
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array($e->getMessage());
                   return Redirect::refresh()
                      ->withErrors($errors);
                }

    			// log the user in
                try{
                     Sentry::login($user, false);

                }
    			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array(array($e->getMessage()));
                   return Redirect::refresh('login')
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array(array($e->getMessage()));
                   return Redirect::refresh('login')
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array(array($e->getMessage()));
                   return Redirect::refresh('login')
                      ->withErrors($errors);
                }

                // Following is only needed if throttle is enabled
                catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array(array($e->getMessage()));
                   return Redirect::refresh('login')
                      ->withErrors($errors);
                }
                catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
                {
                   $errors = new stdClass();
                   $errors->messages = array(array($e->getMessage()));
                   return Redirect::refresh('login')
                      ->withErrors($errors);
                }
    	
    		    return Redirect::intended('/');  
    		}
    		
    		catch (Sentry\SentryException $e) {
    			// issue logging in via Sentry - lets catch the sentry error thrown
    			// store/set and display caught exceptions such as a suspended user with limit attempts feature.
    			$errors = new stdClass();
    			$errors->messages = array($e->getMessage());
    			return Redirect::to("user/login")
    			->withInput()
    			->withErrors($errors);
    		}
    	}


    	return View::make('users.login');
    }

    /**
     * Edit the user profile
     */
    public function edit(){

    	return View::make('users.edit');	
    }

    /**
     * Default my home page
     */
    public function my(){
    	

    	return View::make('users.my');
    }


    public function activate() {
    	try {
    		$email = filter_var(urldecode(Input::get('email')), FILTER_SANITIZE_EMAIL);
    		$hash = filter_var(urldecode(Input::get('hash')), FILTER_SANITIZE_STRING);
    		
    		$user = Sentry::getUserProvider()->findByLogin($email);

    		if ($user->attemptActivation($hash) ) {
    			Sentry::loginAndRemember($user);
    			Session::flash("messages",array(Lang::get('user.activate success')));
    			return Redirect::to("/");
            }
    	}
    	catch (Sentry\SentryException $e) {
    		$errors = new stdClass();
    		$errors->messages = array(array($e->getMessage()));
    		return Redirect::to('message')
    		->withErrors($errors);
    	}
        catch (Sentry\UserAlreadyActivatedException $e){
            $errors = new stdClass();
            $errors->messages = array(array($e->getMessage()));
            return Redirect::to('message')->withErrors($errors);
        }
        catch (Sentry\Cartalyst\Sentry\Users\UserNotFoundException $e){
            $errors = new stdClass();
            $errors->messages = array(array($e->getMessage()));
            return Redirect::to('message')->withErrors($errors);
        }
    }


    public function register(){

    	/** handle user register **/
        if(Request::getMethod() == 'POST'){

        	//Perform validation first
        	try {
               
                $inputs = Input::all();  	
                //Trimmed inputs
                $inputs = array_map('trim', $inputs);

                
        		//santitize the username
        		$inputs['username'] = filter_var($inputs['username'], FILTER_SANITIZE_STRING);
        		$rules = array(
        				'username'	=>	'required|unique:users|max:100',
        				'email'		=>	'required|email|unique:users|max:100',
        				'password'	=>	'required|between:6,16',
        				'password2'	=>	'required|between:6,16|same:password',
        		);

        		$validation = Validator::make($inputs,$rules);
        		if($validation->fails()) {
        			return Redirect::to("user/register")
        			->withInput()
        			->withErrors($validation);
        		};

        		// create the user
        		$user = Sentry::register(array(
        				'username' => $inputs['username'],
        				'email' => $inputs['email'],
        				'password' => $inputs['password'],
        		));
        		
        		if ($user) {

                    /** code here needs to be refactored **/
        			// if(App::environment() == 'dev')
        			//     Mail::pretend();
    					
    				$activation_code = urlencode($user->getActivationCode());
                        				// send email with link to activate, only works with none local environment.
                    Mail::send(array('emails.user.activation', 'emails.user.activation_text'), array('activation_code' => $activation_code, 
                             'username' => $user->username, 'email' => $user->email), function($message) use ($user) {
 

                        $message->to($user->email)
                                ->subject(Lang::get('email.registration title'))
                                ->from(Lang::get('email.return email'));
                    });

        			//add the user group, this needs to be refactored. 
                    $userGroup = Sentry::getGroupProvider()->findByName('Users');
        			$user->addGroup($userGroup);

        			Session::flash("messages",array(Lang::get('user.activiate code')));
        			 
        			return Redirect::to("message");
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
    public function logout()	{
    	Sentry::logout();
    	Session::flush();
    	return Redirect::to('user/login');
    }
    }