@extends('../template/template')

@section('title', 'Regístrate')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection

@section('scripts')
    <script src="{{ asset(env("js")."input/scripts/register.js") }}"></script>
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
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 card auth-form">
            <h1>¡Regístra un usuario!</h1>
            <form action="{{ url("register") }}" method="post" id="register">
                @csrf
                <div class="form-group">
                    <label for="Username">Nombre de la persona:</label>
                    <input type="text" class="form-control" placeholder="Nombre de la persona" id="Name" name="name" required autofocus>
                    @error("username")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Username">Nombre de usuario:</label>
                    <input type="text" class="form-control @error("username") is-invalid @enderror" placeholder="Nombre de usuario" id="Username" name="username" required value="{{ old("username") }}" autocomplete="username" autofocus>
                    @error("username")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Email">Correo:</label>
                    <input type="email" class="form-control @error("email") is-invalid @enderror" placeholder="Correo" id="Email" name="email" value="{{ old("email") }}" required autocomplete="email" autofocus>
                    @error("email")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Password">Contraseña:</label>
                    <input type="password" class="form-control @error("password") is-invalid @enderror" placeholder="Contraseña" id="Password" name="password" required autocomplete="new-password">
                    @error("password")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirma la contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="rol">Confirma la contraseña:</label>
                    <select name="rol" id="rol" class="form-control">
                        <option value="3">Administrador</option>
                        <option value="2">Planificador</option>
                        <option value="1">Usuario</option>
                    </select>
                </div>
                <div class="button-container">
                    <button class="btn btn-info btn-lg" type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
@endsection