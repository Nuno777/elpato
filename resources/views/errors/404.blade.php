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

<body class="" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center mt-5">
                <div class="text-center page-404">
                    {{-- <h1 class="error-title">404</h1> --}}
                    <img src="{{ asset('/images/error404.gif') }}" width="100%" alt="Error 404">
                    <p class="pt-4 pb-5 error-subtitle">Looks like something went wrong.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-pill">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
