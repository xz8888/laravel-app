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
                    echo 'Login field is required.';
                }
               
                catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
                {
                    echo 'Password field is required.';
                }
                catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
                {
                    echo 'Wrong password, try again.';
                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    echo 'User was not found.';
                }
                catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
                {
                    echo 'User is not activated.';
                }

                // The following is only required if throttle is enabled
                catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
    			{
                    echo 'User is suspended.';
                }
                catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
                {
                    echo 'User is banned.';
                }

    			// log the user in
                try{
                     Sentry::login($user, false);

                }
    			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
                {
                    echo 'Login field is required.';
                }
                catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
                {
                    echo 'User not activated.';
                }
                catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                {
                    echo 'User not found.';
                }

                // Following is only needed if throttle is enabled
                catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
                {
                    $time = $throttle->getSuspensionTime();

                    echo "User is suspended for [$time] minutes.";
                }
                catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
                {
                    echo 'User is banned.';
                }
    	
    		    return Redirect::intended('/');  
    		}
    		
    		catch (Sentry\SentryException $e) {
    			// issue logging in via Sentry - lets catch the sentry error thrown
    			// store/set and display caught exceptions such as a suspended user with limit attempts feature.
    			$errors = new stdClass();
    			$errors->messages = array(array($e->getMessage()));
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
    		->withErrors($errors);
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
        			if(App::environment() != 'dev'){
        				
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
        				->from(Config::get('application.juzi_config.contact_address'), Lang::get('common.title'))
        				->subject('Your BreezeStreet.com Activation.')
        				->body($body)
        				->html(true)
        				->send();
        			}
        	
        			//add the user group
        		
                    $userGroup = Sentry::getGroupProvider()->findById(2);
        			$user->addGroup($userGroup);
        			
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
    public function logout()	{
    	Sentry::logout();
    	Session::flush();
    	return Redirect::to('user/login');
    }
    }