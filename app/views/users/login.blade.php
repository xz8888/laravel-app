@layout('layouts.juzi_common')

@section('content')
<div class="container">
<hr />
    <div class="span12">
		<div class="row">
		<?php
		echo 
		'<div class="span4 offset4 well" id="login-page">',
			'<h1>', Lang::line('user.login'), '</h1>',
			Form::open(URL::to('user/login'),'POST'),
				Form::label('email',Lang::line('user.label email')),
				Form::text('email'),
				Form::label('password',Lang::line('user.label password')),
				Form::password('password'),
				'<br >',
				Form::labelled_checkbox('remember', Lang::line('user.label remember'), 'true', false), 
				"<p>".Lang::line('user.register promo')."<a class='juzi-font-color' href='/user/register'><strong>".Lang::line('user.register text')."</strong></a></p>",
				'<hr >',
				Form::token(),
				Form::submit(Lang::line('user.login'),
					array('class' => 'btn-login btn-info tn-large')),
			Form::close(),
		'</div>';
		?>
		</div>
	</div>
</div>
@endsection