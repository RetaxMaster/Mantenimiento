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
        <span>Cantidad de artículos maestros registrados: <b>{{ count($master) }}</b></span>
    </div>
    <span class="label">Todos los artículos maestros registrados:</span>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Total registrados</th>
            <th scope="col">Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($master as $master)
            <tr>
                <th scope="row">{{ $master->id }}</th>
                <td>{{ $master->name }}</td>
                <td>{{ count($master->articulos) }}</td>
                <td>{{ get_short_date_from_timestamp($master->created_at) }} {{ get_time_from_timestamp($master->created_at) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>