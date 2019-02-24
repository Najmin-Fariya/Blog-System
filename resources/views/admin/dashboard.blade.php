<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>
        <!-- Invoice Style CSS -->
        <!-- css links -->
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('backEnd/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('backEnd/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('backEnd/dist/css/sb-admin-2.css') }}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{{asset('backEnd/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{asset('backEnd/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
        
        <!-- Custom Fonts -->
        <link href="{{ asset('backEnd/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Toaster Js -->
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

        <!-- Multi Select Css -->
        <link href="{{ asset('backEnd/js/multi-select/css/multi-select.css') }}" rel="stylesheet">
        
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'textarea'});</script>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
                @include('admin.includes.header')
                <!-- /.navbar-top-links -->

                    @include('admin.includes.sidebar')
                    <!-- /.sidebar-collapse -->
                <!-- /.navbar-static-side -->

            <div id="page-wrapper">
                @yield('content')

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- script links-->

        <!-- jQuery -->
        <script src="{{ asset('backEnd/vendor/jquery/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('backEnd/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('backEnd/vendor/metisMenu/metisMenu.min.js') }}"></script>
        
        <!-- DataTables JavaScript -->
        <script src="{{asset('backEnd/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('backEnd/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('backEnd/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
        
        <!-- Select Plugin Js -->
        <script src="{{ asset('backEnd/js/bootstrap-select.js') }}"></script>
        
        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('backEnd/dist/js/sb-admin-2.js') }}"></script>
        <!-- Toastr Js -->
        <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
        
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

