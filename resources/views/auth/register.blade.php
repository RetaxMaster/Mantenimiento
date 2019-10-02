@extends('../template/template')

@section('title', 'Regístrate')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">        
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 card auth-form">
            <h1>¡Regístrate!</h1>
            <form action="{{ url("register") }}" method="post">
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
                    <label for="password-confirm">Confirma tu contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="button-container">
                    <button class="btn btn-info btn-lg" type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
@endsection