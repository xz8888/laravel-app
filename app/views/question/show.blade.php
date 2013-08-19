@extends('layouts.juzi_common')

@section('content')
<div class="container">
    <div class="content">
        <div class="row-fluid">
           <div class="col-lg-9">
              <div class="main wrap">
                <div class="row margin-10-bottom ">
                    <div class="col-lg-1">
                      <div class="label label-orange"><i class="icon-tint"></i> {{ trans('question.title-label') }}</div>
                    </div>
                    <div class="col-lg-11 no-padding">
                      <div class="question-title">
                         {{ $question->title }}
                      </div>
                    </div>
                </div>

                  <div class="question-content">

                    <!-- Question information row -->
                    <div class="row question-info"> 
                       <div class="col-lg-12">
                          <div>
                             <ul class="nav nav-pills">
                                <li>
                                  <i class="icon-user red-text"> </i>
                                    <span class="small-text red-text">{{ $question->owner_display_name }}</span> |
                                  
                                </li>
                                <li class="small-text">
                                  {{ trans('common.created_time') }}: {{ $question->created_at }}
                                </li>
                             </ul>
                          </div>
                       </div>
                    </div> 
                    <div class="content-question">
                      {{ $question->body }}
                    </div>
                  </div>
                 
                  @include('question.elements.answer') 
     
                  
                  @include('question.forms.answer_reply_form')
               </div>

           </div>
           <div class="col-lg-3">
              @include('question.sidebar.question_sidebar')
           </div>
        </div>
    </div>
</div>
@stop