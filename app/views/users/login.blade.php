@extends('layouts.juzi_common')

@section('content')
<div class="container">
<hr />
    <div class="col-lg-12">
		<div class="row">
	      <div class="col-lg-4 col-lg-offset-4" id="login-page">
	      	 <h1 class="title"><i class="icon-arrow-right"> {{ trans('user.login') }}</i></h1>
  
	          {{ Form::open(array('url' => 'user/login', 'method' => 'POST', 'class' => 'form-horizontal')) }}
              <div class="form-group">
	            {{ Form::label('email',Lang::get('user.label email'), array('class' => 'col-lg-3 control-label')) }}
		        <div class="col-lg-9">
		           {{ Form::text('email', '', array('class' => 'form-control')) }}
		        </div>
		      </div>

		      <div class="form-group">
		        {{ Form::label('password',Lang::get('user.label password'), array('class' => 'col-lg-3 control-label')) }}
			    <div class="col-lg-9">
			       {{ Form::password('password',  array('class' => 'form-control')) }}
			    </div>
			  </div>
              <div class="form-group">
              	 <div class="col-lg-offset-3 col-lg-9">
                    <label>
		              {{ Form::checkbox('remember', 'remember_me', 'true', false) }} {{trans('user.label remember')}}
		            </label>
		          </div>
		      </div>
		      <div class="form-group">
		      	<div class="col-lg-offset-3 col-lg-9">
		      		{{ trans('user.register promo') }}<a class='juzi-font-color' href='/user/register'><strong> {{ Lang::get('user.register text') }}</strong></a>
		        </div>
		      </div>
		   {{ Form::token() }}
		     <div class="form-group">
		      	<div class="col-lg-offset-3 col-lg-9">
		           <input type="submit" class="btn btn-primary" value="{{ trans('user.login') }}"> 
		        </div>
		     </div>
		   {{ Form::close() }}
		  </div>
		</div>
	</div>
</div>
@stop