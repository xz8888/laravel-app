<div class="answer">
	<div class="label label-info"><i class="icon-lightbulb"> {{ trans('question.answer-label') }}</i></div>
	<div class="answers">
	    @if(sizeof($question->answers) > 0)
			@foreach ($question->answers as $answer)
    		 <!-- Question information row -->
                <div class="row answer-info"> 
                    <div class="col-lg-12">
                        <div>
                            <ul class="nav nav-pills">
                                <li>
                                  <i class="icon-user red-text">  </i>
                                   <span class="small-text red-text">{{ $answer->owner_display_name }}</span> |
                                 
                                </li>

                                 <li class="small-text">
                                  {{ trans('common.created_time') }}: {{ $question->created_at }}
                                </li>
                             </ul>
                          </div>
                     </div>
                </div>
                <div class="answer-content">
                	{{ $answer->body}}
                </div>

            <!-- answer content -->

			@endforeach
		@else
		    <h1 class="title">{{ trans('question.no-answer') }}
		@endif
	</div> 
</div>

</div>