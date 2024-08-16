<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @php
    $unreadMessages = 3; // Simula 3 notificaciones
@endphp

    <!-- Incluye el CSS del Navbar -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/requestdetail.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        @if (!request()->is('register','login'))
            @include('layouts.AppNav')
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
