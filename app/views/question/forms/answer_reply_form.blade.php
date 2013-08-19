<div class="row">
  <div class="create-form white-box">
    <div class="col-lg-12">
    
        {{ Form::open(array('url' => 'question-reply', 'class' => 'form-horizontal')) }}
      <div class="form-group">
      {{ Form::hidden('title', 'System Default Value', array('type' => 'hidden')) }}
      </div>

      <div class="form-group">
        {{ Form::label('content', Lang::get('question.answer')) }}
      </div>
     
      <div class="form-group">
        {{ Form::textarea('content') }}
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