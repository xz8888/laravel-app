<?php

class BaseController extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	
	public function __call($method, $parameters)
	{
		return App::abort('404');
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