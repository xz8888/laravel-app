{{ Form::open(array('url' => 'question-store')) }}
  <?php
     
     echo Form::label('title', Lang::get('question.title'));
     echo Form::text('title', '', array('placeholder' => trans('question.create')));

     echo Form::label('content', Lang::get('question.content'));
     echo Form::textarea('content');

     echo Form::label('tags', Lang::get('common.tags'));
     echo Form::text('tags');
      
     echo "<br />"; 
     echo Form::token();
     echo Form::submit(Lang::get('common.submit'), array('class' => 'btn'));
  ?>

{{ Form::close() }}