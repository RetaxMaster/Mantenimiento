@extends('../template/template')

@section('title', 'Artículos maestros')

@section('scripts')
    <script src="{{ asset(env("js")."input/scripts/master.js") }}"></script>
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
            <h2>Artículos maestros</h2>
            <form action="#" method="post" id="addMaster">
                <div class="form-group">
                    <label for="articulo-name">Nombre del artículo maestro</label>
                    <input type="text" class="form-control" placeholder="Nombre del artículo maestro" id="articulo-name" name="articulo-name">
                </div>
                <div class="button-container align-right">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </section>

        <section class="card col-12 pad">
            <h2>Tus artículos maestros</h2>
            <ul class="list" id="allMasters">
                @forelse ($masters as $master) 
                <li id="mas-{{ $master->id }}">
                    <span>{{ $master->name }}</span>
                    <div class="delete">
                        <i class="fas fa-times"></i>
                    </div>
                </li>
                @empty
                <div class="col-12 text-center my-3 text-muted not-found">
                    No hemos encontrado ningún artículo maestro
                </div>
                @endforelse
            </ul>
        </section>

    </main>
@endsection