@extends('layouts.juzi_admin')

@section('content')

<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-md-12">
              <div class="main wrap">
                    @include('admin.forms.create_application_form')
              </div>
           </div>

        </div>
    </div>
</div>
@stop