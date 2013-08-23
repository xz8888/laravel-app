<div class="row">
  <div class="create-form white-box">
    <div class="col-md-12">
    
        {{ Form::open(array('url' => 'question-reply', 'class' => 'form-horizontal')) }}
      <div class="form-group">
      {{ Form::hidden('title', 'System Default Value', array('type' => 'hidden')) }}
      </div>

      <div class="form-group">
        {{ Form::label('content', Lang::get('question.answer')) }}
      </div>
     
      <div class="row form-group">
        <div class="col-md-7">
           {{ Form::textarea('content','',  array('class' => 'form-control', 'rows' => '4')) }}
        </div>
      </div>
      {{ Form::hidden('question_id', $question->id, array('type' => 'hidden')) }}

      {{ Form::token() }}
      <div class="form-group">
         {{ Form::submit(Lang::get('common.submit'), array('class' => 'btn btn-primary')) }}
      </div>  
{{ Form::close() }}
    </div>
  </div>
</div>