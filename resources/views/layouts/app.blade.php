<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-4">
        @yield('content')
    </div>
    <div class="container text-secondary">
        <footer class="border-top p-4">
            <div class="float-right d-none d-sm-inline">
                <strong>SweetHome &copy;<small> VCAL</small></strong> 

            </div>
            All Right Reserved<small> 2021</small>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     @yield('scripts')
</body>
</html>
