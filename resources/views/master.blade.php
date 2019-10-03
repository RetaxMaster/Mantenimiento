@extends('../template/template')

@section('title', 'Artículos maestros')

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection --}}

@section('content')
    <h1>Dashboard</h1>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <h2>Artículos maestros</h2>
            <form action="add-sector" method="post">
                <div class="form-group">
                    <label for="sector-name">Nombre del artículo</label>
                    <input type="text" class="form-control" placeholder="Nombre del artículo" id="sector-name">
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad">
            <h2>Tus artículos</h2>
            <ul class="list">
                @for ($i = 0; $i < 20; $i++) 
                <li>
                    <span>Nombre del artículo</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @endfor
            </ul>
        </section>

    </main>
@endsection