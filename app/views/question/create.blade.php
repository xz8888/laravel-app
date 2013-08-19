@extends('layouts.juzi_common')

@section('content')
<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-lg-9">
              <div class="main wrap">
                    @include('question.forms.question_create_form')
              </div>
           </div>
           <div class="col-lg-3">
              
           </div>
        </div>
    </div>
</div>
@stop