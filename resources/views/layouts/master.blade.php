<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />

    <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />

    <link href="plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="plugins/toaster/toastr.min.css" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="css/style.css" />

    <link href="images/icon.png" rel="shortcut icon" />

    <script src="plugins/nprogress/nprogress.js"></script>
</head>


<body class="navbar-fixed sidebar-fixed" id="body">


    <div class="wrapper">

        @include('layouts.navbar')

        @yield('content')

        @include('layouts.footer')

    </div>
</div>



</body>

</html>
