@extends('layouts.juzi_admin')

@section('content')
<div class="container">
   <div class="row">
   	 <div class="col-md-12">
       <div>
         <ul>
           <li><a href="/admin/questions/add">Add a question</a></li>
         </ul>
       </div>
       <br />
   	 	<div class="panel panel-default">
   	 		<div class="panel-heading">
   	 			{{ trans('question.newest') }}
   	 		</div>
            <div class="panel-body question-module">
            	<div class="row">
            		<?php foreach($questions as $question):?>
            		<div class="col-md-6">
                       <a class="question-link" href="/question/{{ $question->id}}">{{ $question->title }}</a>
                    </div>
                    <div class="col-md-2">
                    	{{$question->created_at;}}
	                  </div>
                    <div class="col-md-3">
                      <a href="/admin/questions/delete/{{ $question->id}}">Delete</a>
                    </div>
                    <?php endforeach;?>
            	</div>
            </div>
   	 	</div>
   	</div>

   </div>
</div>
<div class="container">
   <div class="row">
       <div class="col-md-12">
         <?php echo $questions->links(); ?>
       </div>
   </div>
</div>
@stop

