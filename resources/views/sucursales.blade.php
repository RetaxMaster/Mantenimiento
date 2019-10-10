@extends('../template/template')

@section('title', 'Sucursales')

@section('scripts')
    <script src="{{ asset(env("js")."input/scripts/sucursales.js") }}"></script>
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
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <h2>Sectores</h2>
            <form action="#" method="post" id="addSector">
                <div class="form-group">
                    <label for="sector-name">Nombre del sector</label>
                    <input type="text" class="form-control" placeholder="Nombre del sector" id="sector-name" name="sector-name">
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h2>Sucursales</h2>
            <form action="#" method="post" class="row" id="addSucursal">
                <div class="form-group col-12 col-sm-6">
                    <label for="sucursal-name">Nombre de la sucursal</label>
                    <input type="text" class="form-control" placeholder="Nombre de la sucursal" id="sucursal-name" name="sucursal-name">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="sector-sucursal-name">Sector de la sucursal</label>
                    <select id="sector-sucursal-name" name="sector-sucursal-name" class="form-control">
                        @foreach ($sectores as $sector)
                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad mb-4">
            <h2>Tus sucursales</h2>
            <ul class="list" id="allSucursal">
                @forelse ($sucursales as $sucursal) 
                <li id="suc-{{ $sucursal->id }}">
                    <span>{{ $sucursal->name }}</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @empty
                <div class="col-12 text-center my-3 text-muted not-found">
                    No hemos encontrado ningún usuario
                </div>
                @endforelse
            </ul>
        </section>

        <section class="card col-12 pad">
            <h2>Tus sectores</h2>
            <ul class="list" id="allSectors">
                @forelse ($sectores as $sector) 
                <li id="sec-{{ $sector->id }}">
                    <span>{{ $sector->name }}</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @empty
                <div class="col-12 text-center my-3 text-muted not-found">
                    No hemos encontrado ningún sector
                </div>
                @endforelse
            </ul>
        </section>

    </main>
@endsection