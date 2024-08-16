<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="{{ asset('css/appnavi.css') }}" rel="stylesheet" />
    @yield('styles')
</head>
<body class="sb-nav-fixed">

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('layouts.partials.sidebar_user')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" id="mainContent">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
crossorigin="anonymous">
</script>

<script src="{{ asset('js/script.js') }}"></script>
@yield('scripts')
</body>
</html>
