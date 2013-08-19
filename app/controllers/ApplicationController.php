<?php

class ApplicationController extends BaseController {

    /**
     * 
     * The share function 
     *
     *
     */
    protected $default_date = '0000-00-00';
    protected $default_type = 'pnp';
    protected $default_office = 'buffalo';
    protected $default_transfer = 'ottawa';

    public function share(){
      
      if(Request::getMethod() == 'POST'){
      
         $inputs = Input::all();
         
         //check for validation
         $rules = array(
            'sent' =>  'required|date',
            'type' =>  'required'
        );

         $messages = array(
            'sent.required' => Lang::get('immigration.sent_required'), 
            'type.required' => Lang::get('immigration.type_required')
         );
            
        $validation = Validator::make($inputs,$rules, $messages);

        if($validation->fails()) {
            return Redirect::refresh()
                ->withInput()
                ->withErrors($validation);
        }
         
         $application = new Application();

         $application->sent = empty($inputs['sent']) ? $this->default_date : $inputs['sent'];
         $application->co = empty($inputs['co']) ? $this->default_date : $inputs['co'];
         $application->fn = empty($inputs['fn']) ? $this->default_date : $inputs['fn'];
         $application->me = empty($inputs['me']) ? $this->default_date : $inputs['me'];
         $application->mes = empty($inputs['mes']) ? $this->default_date : $inputs['mes'];
         $application->mer = empty($inputs['mer']) ? $this->default_date : $inputs['mer'];
         $application->pr = empty($inputs['pr']) ? $this->default_date : $inputs['pr'];

         $application->type = empty($inputs['type']) ? 'cec' : $inputs['type'];
         $application->office = empty($inputs['office']) ? 'buffalo' : $inputs['office'];
         $application->transfer = empty($inputs['transfer']) ? 'ottawa' : $inputs['transfer'];
         $application->comment = Purifier::clean($inputs['comment']);

         $user = Sentry::getUser();
         $application->user_id = $user->id;

         //calculate the wait time
         $application->calculateWaitTime();

         //save the application
         $theApplication = $application->save();

         if($theApplication)
            return Redirect::to('/message')->with('messages', array(Lang::get('immigration.creation success')));
         else
            return Redirect::to('/message')->with('error_messages', array(Lang::get('immigration.creation error')));
      }
      else 
          return View::make('application.share');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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