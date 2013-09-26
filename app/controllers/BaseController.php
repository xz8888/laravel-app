<?php

class BaseController extends Controller {
    const TYPE_QUESTION = 1; 
    const TYPE_ANSWER = 3;
    /**
* Initializer.
*
* @access public
* @return \BaseController
*/
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        //share the log in data
        View::share('logged_in', Sentry::check());
    }

/**
* Setup the layout used by the controller.
*
* @return void
*/
protected function setupLayout()
{
    if ( ! is_null($this->layout))
      {   
       $this->layout = View::make($this->layout);
      }
    }

}
