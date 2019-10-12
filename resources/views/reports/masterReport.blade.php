<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset(env("css")."bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."report.css") }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
</head>
<body>
    <header>
        <h1>Reporte general</h1>
    </header><br><br>
    <div class="info">
        <span>Cantidad de artículos maestros registrados: <b>{{ count($master) }}</b></span><br>
        <span>Inversión total en mantenimiento: <b>{{ parse_money(array_sum(array_map(function($info){ return $info["inversion"]; }, $info))) }}</b></span>
    </div>
    <span class="label">Todos los artículos maestros registrados:</span>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Total registrados</th>
            <th scope="col">Total invertido</th>
            <th scope="col">Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($info as $info)
            <tr>
                <th scope="row">{{ $info["id"] }}</th>
                <td>{{ $info["name"] }}</td>
                <td>{{ $info["cantidad"] }}</td>
                <td>{{ parse_money($info["inversion"]) }}</td>
                <td>{{ $info["fecha"] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>