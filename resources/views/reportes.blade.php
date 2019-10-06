@extends('../template/template')

@section('title', 'Reportes')

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection --}}

@section('content')
    <h1>Dashboard</h1>
    <h2>¡Obtén los resportes!</h2>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <h3>Reportes de artículos maestros</h3>
            <form action="add-sector" method="post" class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="articulo-maestro-name">Elige un artículo</label>
                    <select name="articulo-maestro-name" id="articulo-maestro-name" class="form-control">
                        @foreach ($masters as $master)
                        <option value="{{ $master->id}}">{{ $master->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn btn-info btn-lg">Generar reporte</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h3>Reportes de artículos por sucursal</h3>
            <form action="add-sector" method="post" class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="sucursal-name">Elige una sucursal</label>
                    <select name="sucursal-name" id="sucursal-name" class="form-control">
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id}}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="articulo-name">Elige un artículo</label>
                    <select name="articulo-name" id="articulo-name" class="form-control">
                        @foreach ($masters as $master)
                        <option value="{{ $master->id}}">{{ $master->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn btn-info btn-lg">Generar reporte</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h3>Reportes de historial de mantenimientos por sucursal</h3>
            <form action="add-sector" method="post" class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="only-sucursal-name">Elige una sucursal</label>
                    <select name="only-sucursal-name" id="only-sucursal-name" class="form-control">
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id}}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container">
                    <button type="submit" class="btn btn-info btn-lg">Generar reporte</button>
                </div>
            </form>
        </section>

    </main>
@endsection