@extends('layouts.juzi_common')

@section('content')
<div class="container">
    <div class="content">
        <div class="row-fluid">
           <div class="span9">
              <div class="main wrap">
                  {{{ $question->title }}}
                  {{{ $question->body }}}
                 
                  @foreach ($question->answers as $answer)
                      <?php var_dump($answer);?>
                  @endforeach
                  
                  @include('question.forms.answer_reply_form')
               </div>

           </div>
           <div class="span3">
              @include('layouts.elements.sidebar_home')
           </div>
        </div>
    </div>
</div>
@stop