<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Ecommerce | @yield('title', '')</title>

    <link href="/img/favicon.ico" rel="SHORTCUT ICON" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/responsive.css') }}">

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('extra-css')
</head>


<body class="@yield('body-class', '')">
@include('component.nav')

@yield('content')

@include('component.footer')

@yield('extra-js')

</body>
</html>
