<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset(env("css")."bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."style.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."queries.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."modal.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."visor.css") }}">
    @yield('css', "")
    @yield('queries', "")
    <title>@yield('title', "")</title>
    <title>Document</title>
</head>
<body>
    
    <header></header>

    @yield('content')

    @routes
    {{-- Bootstrap --}}
    <script src="{{ asset(env("js")."lib/bootstrap.min.js") }}"></script>
    {{-- FontAwesome Free --}}
    <script src="{{ asset(env("js")."lib/all.min.js") }}"></script>
    {{-- Modificadores de algunas clases de JavaScript --}}
    <script src="{{ asset(env("js")."lib/modifiers.js") }}"></script>
    @yield('scripts', "")
</body>
</html>