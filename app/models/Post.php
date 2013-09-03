<?php

class Post extends Eloquent {
    
    protected $table = 'posts';
    
    protected $guarded = array();

    public static $rules = array();

    public static $types = array(
        'Question' => 1,
        'Answer'   => 3
    );

    /**
     *
     * Retrieve the posts
     *
     */
    public static function getPosts($type = 'Question', $order='new', $count=20, $paginate = false){

       /** TODO: handle invalid type exception **/
       
       if(!$paginate)
           $posts = DB::table('posts')->where('post_type_id', self::$types[$type])
                                      ->orderBy('created_at')->take($count)->get();
       else
           $posts = DB::table('posts')->orderBy('updated_at')->paginate($count);

       return $posts;

    }

    public function postType(){
    	return $this->hasOne('PostType');
    }

    public static function getPostsByUser($type = 'Question', $user_id){
      $posts = DB::table('posts')->where('post_type_id', self::$types[$type])
                                 ->where('user_id','=', $user_id)
                                 ->orderBy('created_at')->get();
  
      return $posts;
    }

}