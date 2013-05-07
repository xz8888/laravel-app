@layout('layouts.juzi_form')

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
						Lang::line('user.register text'),
					'</h1></div>',
					'<div class="span4">',
					Form::open(URL::to('user/register'),'POST'),
	
					//Username
					Form::control_group(
					    Form::label('username', Lang::line('user.label username')),
					    Form::text('username', Input::old('username'), array(
					    		               'placeholder' => '', 
					    		   )), $errors->has('username') ? 'error' : '',		
				        Form::block_help($errors->has('username') ? $errors->first('username') : '')),
					
					// Email
					Form::control_group(
						 Form::label('email',Lang::line('user.label email')),
						 Form::text('email',Input::old('email'),array(
										'placeholder' => 'email@example.com',
							)), $errors->has('email') ? 'error' : '',
						 Form::block_help($errors->has('email') ? $errors->first('email') : '')),
	
					// City
	
					Form::control_group(
						Form::label('city',Lang::line('common.city')),
						Form::select('city',  array(
		                        'toronto' =>Lang::line('common.city toronto'),
								'vancouver' => Lang::line('common.city vancouver'),
								'montreal' => Lang::line('common.city montreal'),
								'calgary' => Lang::line('common.city calgary'),
								'edmonton'=> Lang::line('common.city edmonton'),
								'hamilton' => Lang::line('common.city hamilton'),
								'ottawa' => Lang::line('common.city ottawa'),
								'quebec' => Lang::line('common.city quebec'),
	                            'other' => Lang::line('common.city other')
								), Input::old('city')),	$errors->has('city') ? 'error' : '',
						Form::block_help($errors->has('city') ? $errors->first('city') : '')),
				
					
					// Passwords
					Form::control_group(
						 Form::label('password',Lang::line('user.label password')),
						 Form::password('password'), $errors->has('password') ? 'error' : '',
						 Form::block_help($errors->has('password') ? $errors->first('password') : '')),
				
					Form::control_group(
						 Form::label('password2',Lang::line('user.label password2')),
						 Form::password('password2'), $errors->has('password2') ? 'error' : '',
						 Form::block_help($errors->has('password2') ? $errors->first('password2') : '')),
				
					Form::token(),
						 Form::submit(Lang::line('common.label submit'),array('class' => 'btn btn-info btn-large btn-block')),
					'</div>',
					Form::close();
				
				?>
				</div>
			</div>
				</div>
    </div>

</div>
@endsection