<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/images/icon.png') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/stylelogin.css') }}">

</head>

<body>
    <section class="ftco-section">
        @yield('content')
    </section>

    @include('layouts.footer-login')
    @stack('scripts')
</body>

</html>
