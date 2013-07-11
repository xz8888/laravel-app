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
}