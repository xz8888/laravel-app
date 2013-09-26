@extends('layouts.juzi_admin')

@section('content')
  <div class="container">
    <div class="content">
        <div class="row">
           <div class="col-md-9">
              <div class="main wrap">
                    @include('admin.forms.question_create_form')
              </div>
           </div>
           <div class="col-md-3">
              
           </div>
        </div>
    </div>
</div>
@stop