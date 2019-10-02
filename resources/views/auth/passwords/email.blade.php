@extends('../template/template')

@section('title', 'Reestablecer contraseña')

@section('css')
    <link rel="stylesheet" href="{{ asset(env("css")."auth.css") }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 card auth-form">
            <h1>Recupera tu contraseña</h1>
            <p class="little-p text-center">Te enviaremos un correo para que puedas recuperar tu contraseña</p>
            <form action="{{ route("password.email") }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Email">Correo:</label>
                    <input type="email" class="form-control @error("email") is-invalid @enderror" placeholder="Correo" id="Email" name="email" value="{{ old("email") }}" required autocomplete="email" autofocus>
                    @error("email")
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="button-container">
                    <button class="btn btn-info btn-lg" type="submit">Recuperar</button>
                </div>
                @if (session("status"))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ session("status") }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection