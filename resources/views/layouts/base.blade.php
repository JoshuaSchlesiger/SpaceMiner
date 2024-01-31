<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Mining tool for Star Citizen that not only tracks your crew's payment amounts but also has the ability to save mission assignments">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="author" content="DochSergeantTV">
    <title>SpaceMiner | Calculate stone values and save tasks in Star Citizen</title>

    @if (!Request::is('/', '/aboutme', '/privacypolicy', '/calculator', '/register', '/login'))
        <meta name="robots" content="noindex,nofollow"/>
    @endif

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/welcome.css', 'resources/css/calculator.css', 'resources/css/task.css', 'resources/css/dashboard.css', 'resources/css/auth.css'])
    <link rel="icon" href="{{ url('images/favicon/IconDark192.png') }}">
    <link rel="icon" href="{{ url('images/favicon/IconLight192.png') }}">

    @php
        $urlParts = parse_url(url()->current());
        $lastSegment = isset($urlParts['path']) ? basename($urlParts['path']) : 'welcome';
    @endphp

    @if (!auth()->check() && ($lastSegment === 'dashboard ' || $lastSegment === 'tasks '))
        <meta name="robots" content="noindex, nofollow">
    @endif

    @livewireStyles
    @cookieconsentscripts
</head>

<body>
    <head>
        @include('layouts.nav')
        @yield('nav')
    </head>


    @yield('content')

    @include('layouts.footer')
    @include('popper::assets')
    @yield('footer')
    @livewireScripts
    @cookieconsentview
</body>

</html>
