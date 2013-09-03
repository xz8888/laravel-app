@extends('layouts.juzi_common')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9">

			<!-- my application starts !-->
			<div class="module">
				<h4 class="title">{{ trans('immigration.my_application') }}</h4>
				<div>
					<ul>
						@foreach($applications as $application)
							<li><a class="question-link">{{ $application->type }} - {{ $application->created_at }} {{ $application->title }}</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		  	
			<!-- my quesiton starts !-->
			<div class="module">
				<h4 class="title">{{ trans('question.my_question') }}</h4>
				<div>
					<ul>
						@foreach($questions as $question)
							<li><a class="question-link" href="/question/{{ $question->id }}">{{ $question->title }}</a></li>
						@endforeach
					</ul>
				</div>
		    </div>

		</div>
		<div class="col-md-3">
		</div>
	</div>	
</div>
@stop