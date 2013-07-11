<?php 

class Answer extends Post{

	protected $table = 'posts';

    /**
     *
     *  Getting the parent answer.
     * 
     */
	public function question(){
       return $this->belongsTo('Question');
	}
}