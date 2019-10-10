@extends('../template/template')

@section('title', 'Artículos')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."jquery-ui.min.css") }}">
    <link rel="stylesheet" href="{{ asset(env("css")."jquery-ui.theme.min.css") }}">
@endsection

@section('scripts')
    <script src="{{ asset(env("js")."lib/jquery-ui.min.js") }}"></script>
    <script src="{{ asset(env("js")."input/scripts/articulos.js") }}"></script>
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
            <h2>Artículos</h2>
            <form action="#" method="post" class="row" id="addArticulo">
                <div class="form-group col-12 col-sm-6">
                    <label for="articulo-name">Elige un artículo</label>
                    <select name="articulo-name" id="articulo-name" class="form-control" required>
                        @foreach ($masters as $master)
                        <option value="{{ $master->id }}">{{ $master->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="sucursal-name">¿A qué sucursal irá?</label>
                    <select name="sucursal-name" id="sucursal-name" class="form-control" required>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="picture">Selecciona la foto del equipo (Opcional)</label>
                    <input type="file" class="form-control-file no-required" name="picture" id="picture">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="manual">Selecciona el manual de mantenimiento (Opcional)</label>
                    <input type="file" class="form-control-file no-required" name="manual" id="manual">
                </div>
                <div class="form-group col-12 col-sm-6 col-md-3">
                    <label for="cost">Costo de mantenimiento</label>
                    <input type="number" class="form-control" name="cost" id="cost" placeholder="Costo" required>
                </div>
                <div class="form-group col-12 col-sm-6 col-md-3">
                    <label for="cost">Cantidad en existencia</label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en existencia" required>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="mantainment-date">Fecha de mantenimiento</label>
                    <input type="text" class="form-control" name="mantainment-date" placeholder="dd/mm/yyyy" id="mantainment-date" required>
                </div>
                <div class="form-group col-12">
                    <label>Elige a las personas encargadas del mantenimiento de este artículo</label>
                    <div class="checkboxes">
                        
                        @forelse ($users as $user)
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input user-asigned" id="user-{{ $user->id }}" value="{{ $user->id }}">
                            <label class="custom-control-label" for="user-{{ $user->id }}">{{ $user->username }}</label>
                        </div>
                        @empty
                        <div class="col-12 text-center my-3 text-muted">
                            No hemos encontrado ningúna sucursal
                        </div>
                        @endforelse
                    </div>
                </div>
                @if (count($users) > 0)
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
                @endif
            </form>
        </section>

        <section class="card col-12 pad">
            <h2>Tus artículos</h2>
            <div class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="sort-by-sucursal-name">¿En cuál sucursal quieres buscar?</label>
                    <select id="sort-by-sucursal-name" class="form-control">
                        <option value="0">General</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="search-by-articulo-name">Busca un artículo en especifico</label>
                    <input type="text" class="form-control" placeholder="Nombre del artículo" id="search-by-articulo-name">
                </div>
            </div>
            <ul class="list" id="Articulos">
                @forelse ($articulos as $articulo) 
                <li id="art-{{ $articulo->id }}">
                    <span>{{ $articulo->master->name }}</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @empty
                <div class="col-12 text-center my-3 text-muted not-found">
                    No hemos encontrado ningún artículo
                </div>
                @endforelse
            </ul>
        </section>

    </main>
@endsection