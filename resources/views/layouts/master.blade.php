<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="{{ asset('/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <link href="{{ asset('/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

    <link href="{{ asset('/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="{{ asset('/css/style.css') }}" />

    <link href="{{ asset('/images/icon.png') }}" rel="shortcut icon" />

    <script src="{{ asset('/plugins/nprogress/nprogress.js') }}"></script>
</head>


<body class="navbar-fixed sidebar-fixed" id="body">
    <div class="wrapper">

        @include('layouts.navbar')

        @if (Session::has('message'))
            <div class="alert alert-success" id="toaster-success" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#4f5962;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('content')

        @include('layouts.footer')
        @stack('scripts')
    </div>
    </div>

</body>

</html>
