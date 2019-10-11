<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset(env("site_images")."icon.ico") }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(env("css")."bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."style.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."queries.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."modal.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."visor.css") }}">
    @yield('css', "")
    @yield('queries', "")
    <title>@yield('title', "") - {{ env("APP_NAME") }}</title>
    <title>Document</title>
</head>
<body>
    {{-- @include('partials/facebookscript') --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="{{ route("home") }}">
                <div class="image-container">
                    <span>Logo</span>
                    {{-- <img src="{{ asset(env("site_images")."/logo.png") }}" alt="Logo"> --}}
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav ml-auto">
                    @if (auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("sucursales") }}">Sucursales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("master") }}">Artículos maestros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("articulos") }}">Artículos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("reportes") }}">Reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("graficos") }}">Gráficos</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route("logout") }}" method="post">
                                @csrf
                                <button class="nav-link" type="submit" title="Cerrar sesión"><i class="fas fa-power-off"></i></button>
                            </form>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link not-hover" href="{{ route("login") }}">
                            <div class="beauty-button">
                                Iniciar sesión
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <div class="w-100 text-center copy mt-3 bg-primary text-white">
            Sistema de mantenimiento - Desarrollado por RetaxMaster
        </div>
    </footer>

    @routes
    {{-- jQuery --}}
    <script src="{{ asset(env("js")."lib/jquery.js") }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset(env("js")."lib/bootstrap.min.js") }}"></script>
    {{-- FontAwesome Free --}}
    <script src="{{ asset(env("js")."lib/all.min.js") }}"></script>
    {{-- Modificadores de algunas clases de JavaScript --}}
    <script src="{{ asset(env("js")."lib/modifiers.js") }}"></script>
    {{-- SweetAlert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ asset(env("js")."input/functions/modal.js") }}"></script>
    <script src="{{ asset(env("js")."input/scripts/scripts.js") }}"></script>

    <script>
        
    var js = "{{ asset(env("js")) }}";
    var css = "{{ asset(env("css")) }}";

    </script>
    @yield('scripts', "")
</body>
</html>