@layout('layouts.juzi_common')

@section('content')
   {{ render('layouts.elements.announce')}}
   
   <div class="container">
       <div class="content">
           <div class="row-fluid">
              <div class="span9">
                 <div class="main wrap">
                    <h4>{{ __('immigration.progress') }}</h4>
                    @include('home.elements.progress_table')
                 </div>
              </div>
              <div class="span3">
                {{ render('layouts.elements.sidebar_home') }}
              </div>
           </div>
       </div>
   </div>
@endsection
