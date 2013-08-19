<div class="mini-login">
   {{Form::open(array('url' => 'user/login', 'method' => 'POST', 'class' => 'form-inline mini-form'))}}
   
   {{Form::text('email', '', array('placeholder' => Lang::get('user.label email'),'class' => 'input-small'))}}
  
   {{Form::password('password', array('placeholder' => Lang::get('user.label password'),'class' => 'input-small'))}}
   {{Form::checkbox('remember', 'remember_me', 'true', false)}} 
   {{Lang::get('user.label remember')}}
   {{Form::token()}}
   {{Form::submit(Lang::get('user.login'),
				array('class' => 'btn red-button'))}}
   {{Form::close();
	}}
</div>