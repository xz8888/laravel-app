<?php

class BaseController extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	
	public function __construct(){
		
		
		Asset::container('header')->add('juzi', 'css/juzi.css');
		Asset::container('header')->add('awesome', 'css/font-awesome.min.css');
		
		$class = get_called_class();

		switch($class){
			case 'Admin_Controller':
				$this->filter('before', 'admin');
				break;
			case 'User_Controller':
				$this->filter('before', 'user')
				     ->except(array('login', 'register', 'forgetpassword', 'resetpassword', 'logout'));
				break;
		}
	}
	
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
	
	/**
	 * Trim the input 
	 * @return multitype:string
	 */
	public static function trim(){
		//trim the input
		$input = Input::all();
		
		//trim the input
		$trimmedInput = array();
		foreach($input as $key => $value){
			$trimmedInput[$key] = trim($value);
		}
		
		return $trimmedInput;
	}

}