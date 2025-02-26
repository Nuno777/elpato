{{-- <!DOCTYPE html>
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
    <script>
        (function() {
            const isDarkMode = localStorage.getItem("darkMode") === "true";
            if (isDarkMode) {
                document.documentElement.classList.add("dark-mode");
            }
        })();
    </script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <div class="wrapper">

        @include('layouts.navbar')
        @include('layouts.message')

        @yield('content')

        @include('layouts.footer')

        @stack('scripts')
    </div>

</body>

</html>
 --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <link rel="icon" href="favicon.ico">
    <link href="{{ asset('/css/style2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">

    <div class="flex h-screen overflow-hidden">

        @include('layouts.navbar')

        <main>
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6">
                <div class="grid grid-cols-12 gap-4 md:gap-6">

                    @yield('content')

                    @include('layouts.footer')
                </div>
            </div>
        </main>

    </div>

</body>

</html>
