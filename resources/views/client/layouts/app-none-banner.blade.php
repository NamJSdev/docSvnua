<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{asset('client/favicon.png')}}">

    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('client/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('client/fonts/flaticon/font/flaticon.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{asset('client/css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/glightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/flatpickr.min.css')}}">


    <title>@yield('title')</title>
</head>

<body>
    @include('client.layouts.header')
    @include('client.layouts.wrapper')
    @yield('content')
    @include('client.layouts.footer')
    <script src="{{asset('client/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('client/js/tiny-slider.js')}}"></script>

    <script src="{{asset('client/js/flatpickr.min.js')}}"></script>

    <script src="{{asset('client/js/upload.js')}}"></script>
    <script src="{{asset('client/js/aos.js')}}"></script>
    <script src="{{asset('client/js/glightbox.min.js')}}"></script>
    <script src="{{asset('client/js/navbar.js')}}"></script>
    <script src="{{asset('client/js/counter.js')}}"></script>
    <script src="{{asset('client/js/custom.js')}}"></script>
    <script src="{{asset('client/js/navbar2.js')}}"></script>
</body>
</html>
