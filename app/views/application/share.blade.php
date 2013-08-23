@extends('layouts.juzi_common')

@section('content')

<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-md-12">
              <div class="main wrap">
                    @include('application.forms.create_application_form')
              </div>
           </div>

        </div>
    </div>
</div>
@stop