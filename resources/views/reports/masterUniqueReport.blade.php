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
        <h1>Reporte de {{ $master->name }}</h1>
    </header><br><br>
    <div class="info">
        <span>Cantidad de artículos individuales registrados: <b>{{ \App\Articulos::where("master_id", "=", $master->id)->sum("cantidad") }}</b></span><br>
        <span>Inversión total en mantenimiento: <b>{{ parse_money(array_sum(array_map(function($info){ return $info["costos"]; }, $info))) }}</b></span>
    </div>
    <span class="label">Detalles del artículo por sucursal:</span>
    <div class="info">
        <span><b>Sucursal:</b> Nombre de la sucursal</span><br>
        <span><b>Cantidad:</b> Cantidad de articulos registrados en dicha sucursal</span><br>
        <span><b>Costo general:</b> Costo del mantenimiento de un único artículo</span><br>
        <span><b>Costo general:</b> Costo del mantenimiento de todos los artículos de la sucursal (Cantidad de articulos mantenidos x Costo de mantenimiento)</span><br>
        <span><b>Mantenimientos hechos:</b> Mantenimientos realizados a tiempo en la sucursal</span><br>
        <span><b>Mantenimientos vencidos:</b> Mantenimientos no realizados en la sucursal</span>
    </div><br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sucursal</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Costo individual</th>
                <th scope="col">Costo general</th>
                <th scope="col">Mantenimientos hechos</th>
                <th scope="col">Mantenimientos vencidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($info as $info)
                <tr>
                    <th scope="row">{{ $info["name"] }}</th>
                    <td>{{ $info["cantidad"] }}</td>
                    <td>{{ parse_money($info["costos_individual"]) }}</td>
                    <td>{{ parse_money($info["costos"]) }}</td>
                    <td>{{ $info["mantenimientos_hechos"] }}</td>
                    <td>{{ $info["mantenimientos_vencidos"] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>