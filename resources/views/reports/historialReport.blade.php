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
        <h1>Reporte del historial de mantenimientos de la sucursal "{{ $sucursal->name }}"</h1>
    </header><br><br>
    <div class="info">
        <span>Cantidad de artículos existentes en esta sucursal: <b>{{ count($sucursal->articulos) }}</b></span><br>
        <span>Sector de la sucursal: <b>{{ $sucursal->sector->name }}</b></span>
    </div>
    <span class="label">Todos los artículos existentes:</span>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">¿Tiene manual?</th>
                <th scope="col">Costo</th>
                <th scope="col">En existencia</th>
                <th scope="col">Fecha de mantenimiento</th>
                <th scope="col">Último mantenimiento realizado</th>
                <th scope="col">Estado del mantenimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sucursal->articulos as $articulo)
            <tr>
                <th scope="row">{{ $articulo->master->name }}</th>
                <td>{{ ($articulo->manual != null) ? "Si" : "No" }}</td>
                <td>{{ $articulo->costo }}</td>
                <td>{{ $articulo->cantidad }}</td>
                <td>{{ get_short_date_from_timestamp($articulo->fecha_mantenimiento) }} {{ get_time_from_timestamp($articulo->fecha_mantenimiento) }}</td>
                <td>{{ ($articulo->mantenimiento_hecho == 1) ? get_short_date_from_timestamp($articulo->updated_at) . " " . get_time_from_timestamp($articulo->updated_at) : "No se hizo el mantenimiento" }}</td>
                @if ($articulo->mantenimiento_hecho == 1)
                <td class="text-success">Realizado</td>
                @elseif ($articulo->mantenimiento_hecho == 2)
                <td class="text-danger">Vencido</td>
                @else
                <td class="text-muted">Pendiente</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>