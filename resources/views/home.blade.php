@extends('../template/template')

@section('title', 'Mantenimientos pendientes')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."home.css") }}">        
@endsection

@section('scripts')
    <script src="{{ asset(env("js")."lib/jquery-ui.min.js") }}"></script>
    <script src="{{ asset(env("js")."input/scripts/home.js") }}"></script>
@endsection

@section('content')
    <h1>Dashboard</h1>
    <p class="text-secondary">¡Hola! A continuación puedes ver los artículos que tienes pendientes para mantenimiento, tienes adjunto un manual para realizarlo, por favor, en cuanto termines marca la casilla.</p>
    <main role="main">

        <section class="card">
            <ul class="list">
                @forelse ($mantenimientos as $mantenimiento)
                @if ($mantenimiento->mantenimiento_hecho == "0")
                <li>
                    <span>{{ $mantenimiento->name }}</span>
                    <div class="info d-flex justify-content-center align-items-center">
                        <span>{{ get_short_date_from_timestamp($mantenimiento->fecha_mantenimiento) }}</span>
                        @if ($mantenimiento->manual != null)
                        <a href="{{ route("manual", ["name" => $mantenimiento->manual]) }}" class="ml-2" title="Descargar manual de mantenimiento"><i class="fas fa-book"></i></a>
                        @endif
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 ml-2">
                            <input type="checkbox" class="custom-control-input" id="articulo-{{ $mantenimiento->articulo_id }}">
                            <label class="custom-control-label" for="articulo-{{ $mantenimiento->articulo_id }}"></label>
                        </div>
                    </div>
                </li>
                @endif
                @empty
                <div class="col-12 text-center my-3 text-muted not-found">
                    Aún no tienes mantenimientos por realizar
                </div>
                @endforelse
            </ul>
        </section>

        <div class="notifications">
            @foreach ($mantenimientos as $mantenimiento)
                @if ($mantenimiento->articulo->fecha_mantenimiento < date("Y-m-d"))    
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h2 class="notif-title danger">Vencido</h2>
                    <p>El artículo {{ $mantenimiento->name }} venció el {{ get_full_date($mantenimiento->fecha_mantenimiento) }}</p>
                </div>
                @elseif($mantenimiento->fecha_mantenimiento <= add_time(date("Y-m-d"), "3 días"))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h2 class="notif-title warning">Por vencer</h2>
                    <p>El artículo {{ $mantenimiento->name }} vencerá el {{ get_full_date($mantenimiento->fecha_mantenimiento) }}</p>
                </div>
                @endif
            @endforeach
        </div>

    </main>
@endsection