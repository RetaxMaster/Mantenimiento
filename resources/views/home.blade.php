@extends('../template/template')

@section('title', 'Artículos maestros')

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection --}}

@section('content')
    <h1>Dashboard</h1>
    <p class="text-secondary">¡Hola! A continuación puedes ver los artículos que tienes pendientes para mantenimiento, tienes adjunto un manual para realizarlo, por favor, en cuanto termines marca la casilla.</p>
    <main role="main">

        <section class="card">
            <ul class="list">
                @for ($i = 0; $i < 25; $i++)
                <li>
                    <span>Nombre del artículo</span>
                    <div class="info d-flex justify-content-center align-items-center">
                        <span>01/06/2015</span>
                        <a href="#" class="ml-2" title="Descargar manual de mantenimiento"><i class="fas fa-book"></i></a>
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 ml-2">
                            <input type="checkbox" class="custom-control-input" id="articulo-{{ $i }}">
                            <label class="custom-control-label" for="articulo-{{ $i }}"></label>
                        </div>
                    </div>
                </li>
                @endfor
            </ul>
        </section>

    </main>
@endsection