<?php

class Post extends Eloquent {
    
    protected $table = 'posts';
    
    protected $guarded = array();

    public static $rules = array();

    protected static $types = array(
        'Question' => 1,
        'Answer'   => 3
    );

    /**
     *
     * Retrieve the posts
     *
     */
    public static function getPosts($type = 'Question', $order='new', $count=20){

       /** TODO: handle invalid type exception **/


       $posts = DB::table('posts')->where('post_type_id', self::$types[$type])
                                      ->orderBy('created_at')->take($count)->get();

       return $posts;

    }

    public function postType(){
    	return $this->hasOne('PostType');
    }


}