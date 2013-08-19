@extends('layouts.juzi_form')

@section('content')
<div  class="container">
    <div class="content">
		<div class="row">
    		<div class="col-lg-4 col-lg-offset-4">
				<div class="row">
					<h1 class="title"><i class="icon-arrow-right"> {{ trans('user.register text') }}</i></h1>	
                    {{ Form::open(array('url' => 'user/register', 'method' => 'POST', 'class' => 'form-horizontal')) }}				
                    
                    <div class="form-group">
                    	{{Form::label('username', Lang::get('user.label username'), array('class' => 'col-lg-3 control-label')) }}
                    	<div class="col-lg-9">
                        	{{ Form::text('username', '', array('class' => 'form-control')) }}
                    	</div>
                    </div>

                    <div class="form-group">
                        {{  Form::label('email',Lang::get('user.label email'), array('class' => 'col-lg-3 control-label')) }}
                        <div class="col-lg-9">
                        	{{ Form::text('email', '',  array('class' => 'form-control')) }}
                        </div>
                    </div>
                  
                    <div class="form-group">
                        {{ Form::label('password', Lang::get('user.label password'), array('class' => 'col-lg-3 control-label'))}}
                        <div class="col-lg-9">
                            {{ Form::password('password', array('class' => 'form-control'))}}
                        </div>
                    </div>

                    <div class="form-group">
                       {{ Form::label('password2', Lang::get('user.label password2'), array('class' => 'col-lg-3 control-label'))}}
                       <div class="col-lg-9">
                           {{ Form::password('password2', array('class' => 'form-control'))}}
                       </div>
                    </div>
                    {{ Form::token() }}
                    
                    <div class="form-group">
		      	        <div class="col-lg-offset-3 col-lg-9">
		                   <input type="submit" class="btn btn-primary" value="{{ trans('common.label submit') }}"> 
		                </div>
		            </div>
		     		   {{ Form::close() }}
				
				</div>
			</div>
	    </div>
    </div>
</div>
@stop
