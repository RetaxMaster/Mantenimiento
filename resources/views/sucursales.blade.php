@extends('../template/template')

@section('title', 'Sucursales')

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection --}}

@section('content')
    <h1>Dashboard</h1>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <h2>Sectores</h2>
            <form action="add-sector" method="post">
                <div class="form-group">
                    <label for="sector-name">Nombre del sector</label>
                    <input type="text" class="form-control" placeholder="Nombre del sector" id="sector-name">
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h2>Sucursales</h2>
            <form action="add-sucursal" method="post">
                <div class="form-group">
                    <label for="sucursal-name">Nombre de la sucursal</label>
                    <input type="text" class="form-control" placeholder="Nombre de la sucursal" id="sucursal-name">
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h2>Tus sucursales</h2>
            <ul class="list">
                @for ($i = 0; $i < 20; $i++) 
                <li>
                    <span>Nombre de la sucursal</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @endfor
            </ul>
        </section>

        <section class="card col-12 pad">
            <h2>Tus sectores</h2>
            <ul class="list">
                @for ($i = 0; $i < 20; $i++) 
                <li>
                    <span>Nombre del sector</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @endfor
            </ul>
        </section>

    </main>
@endsection