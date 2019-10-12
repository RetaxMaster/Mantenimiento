<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset(env("css")."style.css") }}">
    <title>¡Mantenimiento por vencer!</title>
</head>
<body style="font-family: sans-serif">
    <div style="padding: 20px; background: #1d1d1d; color: #fff; text-align: center;">
        <h1 style="font-size: 20px">¡El mantenimiento para el artículo {{ $data["articulo"] }} está a punto de vencer!</h1>
    </div><br><br>
    <p style="color: #6f6f6f">¡Hola {{ $data["name"] }}! Te recordamos que el mantenimiento para el artículo {{ $data["articulo"] }} vence este {{ get_date_from_timestamp($data["vence"]) }}, por favor realiza el mantenimiento cuanto antes y notificalo en el sistema para evitar el vencimiento del mismo</p><br><br>
    <p style="color: #6f6f6f">Email para: <b>{{ $data["username"] }}</b></p>
</body>
</html>