@extends('../template/template')

@section('title', 'Inicia sesión')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 card auth-form">
            <h1>Inicia sesión</h1>
            <form action="{{ url("login") }}" method="post">
                @csrf
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
                    <label for="Password">Contraseña:</label>
                    <input type="password" class="form-control @error("password") is-invalid @enderror" placeholder="Contraseña" id="Password" name="password" required autocomplete="current-password">
                    @error("password")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <a href="{{ route("password.request") }}" class="link">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="RememberMe" name="remember" {{ old("remember") ? "checked" : "" }}>
                    <label class="custom-control-label" for="RememberMe">Recuérdame</label>
                </div>
                <div class="button-container">
                    <button class="btn btn-info btn-lg" type="submit">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
@endsection