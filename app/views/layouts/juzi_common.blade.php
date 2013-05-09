<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ trans("common.title") }} - {{ isset($title) ? $title : trans("common.title default") }} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    @include('layouts.header.scripts')
</head>
<body>
   @include('layouts.header.navigation') 
   @include('layouts.elements.message') 
   
   @yield('content')
   @include('layouts.footer.footer')
</body>