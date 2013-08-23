@extends('layouts.juzi_common')

@section('content')
<div class="container">
   <div class="row">
   	 <div class="col-md-9">
   	 	<div class="panel panel-default">
   	 		<div class="panel-heading">
   	 			{{ trans('question.newest') }}
   	 		</div>
            <div class="panel-body question-module">
            	<div class="row">
            		<?php foreach($questions as $question):?>
            		<div class="col-md-8">
                       <a class="question-link" href="/question/{{ $question->id}}">{{ $question->title }}</a>
                    </div>
                    <div class="col-md-4">
                    	{{$question->created_at;}}
	                </div>
                    <?php endforeach;?>
            	</div>
            </div>
   	 	</div>
   	</div>
   	<div class="col-md-3">
      
   	</div>
   </div>
</div>

@stop