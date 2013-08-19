<h4 class="title">{{ trans('question.title') }}</h4>

<div class="question-module">
<?php foreach($questions as $question):?>
   <ul>
   	  <li>
         <a class="question-link" href="question/{{ $question->id }}">{{ $question->title }}</a>
      </li>
   </ul> 
<?php endforeach;?>
</div>