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
        <h1>Reporte del artículo {{ $articulos->master->name }} en la sucursal {{ $articulos->sucursal->name }}</h1>
    </header><br><br>
    <div class="image-container">
        <img src="{{ asset(Storage::url("site_images/".$articulos->picture)) }}" alt="Imagen del artículo">
    </div>
    <div class="info">
        <span>Cantidad de artículos en existencia: <b>{{ $articulos->cantidad }}</b></span><br><br>
        @if ($articulos->manual != null)
            <span class="text-muted">Este artículo incluye manual de mantenimiento: <a href="{{ route("manual", ["name" => $articulos->manual]) }}">Descarga el manual</a></span>
        @else 
            <span class="text-muted">Este artículo no incluye manual de mantenimiento</span>
        @endif
    </div>
    <span class="label">Datos específicos:</span>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Costo de mantenimiento</th>
            <th scope="col">Fecha de mantenimiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $articulos->master->name }}</td>
                <td>{{ parse_money($articulos->costo) }}</td>
                <td>{{ get_full_date($articulos->fecha_mantenimiento) }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Mantenimientos realizados</th>
            <th scope="col">Mantenimientos vencidos</th>
            <th scope="col">Fecha de alta del producto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ ($articulos->mantenimiento_hecho == 1) ? $articulos->cantidad : "0" }}</td>
                <td>{{ ($articulos->mantenimiento_hecho == 2) ? $articulos->cantidad : "0" }}</td>
                <td>{{ get_full_date($articulos->created_at) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
{{--get_short_date_from_timestamp--}}