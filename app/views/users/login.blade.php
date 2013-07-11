@extends('layouts.juzi_common')

@section('content')
<div class="container">
<hr />
    <div class="span12">
		<div class="row">
		<?php
		echo 
		'<div class="span4 offset4 well" id="login-page">',
			'<h1>', Lang::get('user.login'), '</h1>',
			Form::open(array('url' => 'user/login', 'method' => 'POST')),
				Form::label('email',Lang::get('user.label email')),
				Form::text('email'),
				Form::label('password',Lang::get('user.label password')),
				Form::password('password'),
				'<br >',
				Form::checkbox('remember', 'remember_me', 'true', false), 
				"<p>".Lang::get('user.register promo')."<a class='juzi-font-color' href='/user/register'><strong>".Lang::get('user.register text')."</strong></a></p>",
				'<hr >',
				Form::token(),
				Form::submit(Lang::get('user.login'),
					array('class' => 'btn-login btn-info tn-large')),
			Form::close(),
		'</div>';
		?>
		</div>
	</div>
</div>
@stop