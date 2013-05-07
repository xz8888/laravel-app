<?php

class Question_Controller extends Base_Controller{
    
    /**
     *
     *  List the questions
     */
    public function action_index(){

       return View::make('questions.index');
    }

    /**
     * view the question with related answers
     */
    public function action_view($id){

    }
}