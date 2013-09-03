<?php

class Question extends Post {
    

    protected $guarded = array();

    public static $rules = array();

    /** retrieve the questions **/
    public static function getQuestions($type='new', $count=20){
   
       return self::getPosts("Question", $type, $count);
    }

    public function answers(){
        return $this->hasMany('Answer', 'parent_id');
    }

    /** getting the latest questions **/
    public static function latest($count = 10){
        return self::getPosts("Question", 'new', $count);	
    }

    /**
     * gettin the questions by user 
     **/
    public static function getQuestionsByUser($user_id){
        return self::getPostsByUser('Question', $user_id);
    }

    public function setNumberOfAnswers($numberOfAnswers){
       $this->answer_count = $numberOfAnswers;
       $this->save();
    }
}