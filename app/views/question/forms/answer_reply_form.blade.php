{{ Form::open(array('url' => 'question-reply')) }}
  <?php
     
     //echo Form::label('title', Lang::get('answer.title'));
     echo Form::hidden('title', 'System Default Value', array('type' => 'hidden'));

     echo Form::label('content', Lang::get('answer.content'));
     echo Form::textarea('content');
      
     echo "<br />";
     echo Form::hidden('question_id', $question->id, array('type' => 'hidden')); 

     echo Form::token();
     echo Form::submit(Lang::get('common.submit'), array('class' => 'btn'));

  ?>

{{ Form::close() }}