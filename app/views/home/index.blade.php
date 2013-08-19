@extends('layouts.juzi_common')

@section('content')
   @if (!$logged_in)
      @include('home.elements.login') 
   @else

   @endif

   <div class="container">
       <div class="content">
           <div class="row">
              <div class="col-lg-8">
                 <div class="main wrap">
                     <div class="time-stats-module">
          
                        @include('home.elements.stats_time')
                     </div>

                     <div class="question-module">
                 
                        @include('home.elements.recent_question')
                     </div>
                 </div>
              </div>
              <div class="col-lg-4">
                 @include('home.sidebar.sidebar_home')
              </div>
           </div>
       </div>
   </div>
@stop
