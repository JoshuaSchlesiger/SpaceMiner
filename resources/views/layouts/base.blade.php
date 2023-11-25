<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SpaceMiner</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/calculator.css', 'resources/css/task.css', 'resources/css/dashboard.css'])
        @livewireStyles
</head>
<body>
    @include('layouts.nav')
    @yield('nav')

    @yield('content')

    @include('layouts.footer')
    @yield('footer')
    @livewireScripts
</body>
</html>
