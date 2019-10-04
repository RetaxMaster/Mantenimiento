@extends('../template/template')

@section('title', 'Artículos')

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection --}}

@section('content')
    <h1>Dashboard</h1>
    <main role="main" class="row">

        <section class="card col-12 pad mb-4">
            <h2>Artículos</h2>
            <form action="add-sector" method="post" class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="articulo-name">Elige un artículo</label>
                    <select name="articulo-name" id="articulo-name" class="form-control">
                        @for ($i = 0; $i < 10; $i++)
                        <option value="{{ $i }}">Articulo</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="sucursal-name">¿A qué sucursal irá?</label>
                    <select name="sucursal-name" id="sucursal-name" class="form-control">
                        @for ($i = 0; $i < 10; $i++)
                        <option value="{{ $i }}">Sucursal</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="picture">Selecciona la foto del equipo (Opcional)</label>
                    <input type="file" class="form-control-file" name="picture" id="picture">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="manual">Selecciona el manual de mantenimiento (Opcional)</label>
                    <input type="file" class="form-control-file" name="manual" id="manual">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="cost">Costo de mantenimiento</label>
                    <input type="number" class="form-control" name="cost" id="cost" placeholder="Costo">
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="mantainment-date">Fecha de mantenimiento</label>
                    <input type="text" class="form-control" name="mantainment-date" placeholder="dd/mm/yyyy" id="mantainment-date">
                </div>
                <div class="form-group col-12">
                    <label>Elige a las personas encargadas del mantenimiento de este artículo</label>
                    <div class="checkboxes">
                        @for ($i = 0; $i < 10; $i++)
                        <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user-{{ $i }}">
                            <label class="custom-control-label" for="user-{{ $i }}">Nombre del usuario</label>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad">
            <h2>Tus artículos</h2>
            <div class="row">
                <div class="form-group col-12 col-sm-6">
                    <label for="sort-by-sucursal-name">¿A qué sucursal irá?</label>
                    <select id="sort-by-sucursal-name" class="form-control">
                        @for ($i = 0; $i < 10; $i++)
                        <option value="{{ $i }}">Sucursal</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label for="search-by-articulo-name">Busca un artículo en especifico</label>
                    <input type="text" class="form-control" placeholder="Nombre del artículo" id="search-by-articulo-name">
                </div>
            </div>
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