<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/welcom.css') }}" rel="stylesheet">
    <title>Welcome to Our Company</title>

</head>
<body>
    <header>
        <div class="container">

            <div class="navigation">
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </header>
    <div class="intro">
        <div>
            <h1>Bienvenido a tu compañía</h1>
            <p>Descubre nuestros servicios y vea cómo podemos mejorar tu negocio con nuestras soluciones personalizadas.</p>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Agroindustrial Literas E.I.R.L. Derechos Reservados.</p>
    </div>
</body>
</html>
