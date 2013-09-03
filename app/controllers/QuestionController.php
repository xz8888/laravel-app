<?php

class QuestionController extends BaseController {

    /**
     * Display a listing of the resource.
     * List the top 20 questions listed recently
     *
     *
     * @todo Cache to increase the performance. Newest and featured 
     * @return Response
     */

    const TYPE_QUESTION = 1; 
    const TYPE_ANSWER = 3;

    public function index()
    {
         //get the number of questions
         $questions = Question::getQuestions('new', 20, true);

         return View::make('question.index', array('questions' => $questions));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       //create the question  
       return View::make('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //validate the question to make sure title and content are included

        $inputs = Input::all();
        $inputs = array_map('trim', $inputs);
        $rules = array(
           'title' => 'required|min:3'
        );

        $validations = Validator::make($inputs, $rules);
        if($validations->fails())
            return Redirect::to('question-create')->withInput()
                                      ->withErrors($validations);

        //purifier the input. title needs to be plain text
        $title = Purifier::clean($inputs['title']);
        $content = Purifier::clean($inputs['content']);
     
        //Create the user
        $user = Sentry::getUser();

        $question = new Question();
        $question->title = $title;
        $question->body = $content; 

        //may need a database query to retrieve the type id in the future
        $question->post_type_id = self::TYPE_QUESTION;
        $question->parent_id = 0;
        $question->user_id = $user->id;
        $question->owner_display_name = $user->username;

        if($question->save()){
            return Redirect::to('/question/show/'.$question->id)->with('message', Lang::get('question.success'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       $question = Question::find($id);

       return View::make('question.show', array('question' => $question)); 
    }

    /**
     *
     *  Reply the question 
     * 
     */
    public function reply(){
        $inputs = Input::all();
        $inputs = array_map('trim', $inputs);
        $rules = array(
           'title' => 'required|min:3',
           'content' => 'required|min:5'
        );
        
        $question = Question::find($inputs['question_id']);
        $user = Sentry::getUser();
 
        $validations = Validator::make($inputs, $rules);
        if($validations->fails())
            return Redirect::to('/question/'.$question->id)->withInput()
                                      ->withErrors($validations);

        //purifier the input. title needs to be plain text
        $title = Purifier::clean($inputs['title']);
        $content = Purifier::clean($inputs['content']);

        
        $answer = new Answer();
        $answer->title = $title;
        $answer->body = $content; 
        $answer->post_type_id = self::TYPE_ANSWER;
        $answer->parent_id = $inputs['question_id'];
        $answer->user_id = $user->id;
        $answer->owner_display_name = $user->username;

        if($answer->save()){
            $question->setNumberOfAnswers(++$question->answer_count);
            return Redirect::to('/question/'.$question->id)->with('message', Lang::get('question.success'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}