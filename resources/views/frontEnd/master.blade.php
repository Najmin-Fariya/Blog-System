<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>
           @yield('title')
        </title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">


        <!-- Font -->

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


        <!-- Stylesheets -->

        <link href="{{ asset('frontEnd/common-css/bootstrap.css') }}" rel="stylesheet">

        <link href="{{ asset('frontEnd/common-css/swiper.css') }}" rel="stylesheet">

        <link href="{{ asset('frontEnd/common-css/ionicons.css') }}" rel="stylesheet">

        <link href="{{ asset('frontEnd/front-page-category/css/styles.css') }}" rel="stylesheet">

        <link href="{{ asset('frontEnd/front-page-category/css/responsive.css') }}" rel="stylesheet">

        <!--post details page css-->
        <link href="{{ asset('frontEnd/single-post-1/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('frontEnd/single-post-1/css/responsive.css') }}" rel="stylesheet">
        
        <!--show All posts Css-->
        <link href="{{ asset('frontEnd/category/css/styles.css')}}" rel="stylesheet">
	<link href="{{ asset('frontEnd/category/css/responsive.css')}}" rel="stylesheet">

        <!-- Toaster Js -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    </head>
    <body >

        @include('frontEnd.includes.header');

        @yield('content')


        @include('frontEnd.includes.footer');


        <!-- SCIPTS -->

        <script src="{{ asset('frontEnd/common-js/jquery-3.1.1.min.js') }}"></script>

        <script src="{{ asset('frontEnd/common-js/tether.min.js') }}"></script>

        <script src="{{ asset('frontEnd/common-js/bootstrap.js') }}"></script>

        <script src="{{ asset('frontEnd/common-js/swiper.js') }}"></script>

        <script src="{{ asset('frontEnd/common-js/scripts.js') }}"></script>

        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <!--Toaster Js-->
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    Toastr::error('{{ $error }}','Error',[
                         'closeButton':true,
                        'progressButton':true,
                    ]);
                @endforeach
            @endif
        </script>
    </body>
</html>
