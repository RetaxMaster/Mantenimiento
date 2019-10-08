@extends('../template/template')

@section('title', 'Gráficos')

@section('scripts')
    <script src="{{ asset(env("js")."lib/highcharts.js") }}"></script>
    <script src="{{ asset(env("js")."input/scripts/graficos.js") }}"></script>
@endsection

@section('content')
    <div class="modal" id="modal">
        <div class="modal-main">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-1 close-modal"></div>
                <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 close-modal">
                    <div class="modal-card" id="loading">
                        <div class="preloader"></div>
                        <span class="tag">Cargando...</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-1 close-modal"></div>
            </div>
        </div>
    </div>

    <h1>Dashboard</h1>
    <h2>Gráficos</h2>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos realizados</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="sucursales-mantenimiento" id="sucursales-mantenimiento" class="form-control">
                        <option value="0">General</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id}}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <div id="mantenimientos"></div>
                </div>
                <div class="col-12 col-sm-6 text-center">
                    <div id="porVencer"></div>
                </div>
            </div>
        </section>

        {{-- <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos por vencer</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="mantenimiento-realizado" id="mantenimiento-realizado" class="form-control">
                        <option value="0">General</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id}}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <div id="vencer"></div>
                </div>
            </div>
        </section>

        <section class="card col-12 pad mb-4">
            <div class="row">
                <h3 class="col-12 col-sm-6">Mantenimientos vencidos</h3>
                <div class="form-group col-12 col-sm-6">
                    <select name="mantenimiento-realizado" id="mantenimiento-realizado" class="form-control">
                        <option value="0">General</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id}}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 text-center">
                    <div id="vencidos"></div>
                </div>
            </div>
        </section> --}}

    </main>
@endsection