@extends('layouts.juzi_form')

@section('content')
<div  class="container">
    <div class="content">
	<div class="register row">
	<hr />
		    <div class="well span4 offset4">
				<div class="row-fluid">
				<?php
	
					echo
					'<div class="page-header"><h1>',
						Lang::get('user.register text'),
					'</h1></div>',
					'<div class="span4">',
					Form::open(array('url' => 'user/register', 'method' => 'post')),
	
					//Username
			        Form::label('username', Lang::get('user.label username')),
					Form::text('username', Input::old('username'), array(
					    		               'placeholder' => '', 
					    		   )), 
					// Email
				    Form::label('email',Lang::get('user.label email')),
				    Form::text('email',Input::old('email'),array(
										'placeholder' => 'email@example.com',
					)),
	
				
					// Passwords
				    Form::label('password',Lang::get('user.label password')),
					Form::password('password'), $errors->has('password') ? 'error' : '',
				
					Form::label('password2',Lang::get('user.label password2')),
					Form::password('password2'), $errors->has('password2') ? 'error' : '',
				
					Form::token(),
						 Form::submit(Lang::get('common.label submit'),array('class' => 'btn btn-info btn-large btn-block')),
					'</div>',
					Form::close();
				
				?>
				</div>
			</div>
				</div>
    </div>

</div>
@stop
