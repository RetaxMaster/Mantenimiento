<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $maxAttempts = 10;
    protected $decayMinutes = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    //El login se hace por medio del nombre de usuario
    public function username() {
        return 'username';
    }

    //Cuando el usuario cierra sesión
    protected function loggedOut() {
        return redirect()->route("login");
    }

    //Ruta a la que se reedirigirá cuando haga login, uso un método y no una propiedad porque la propiedad me obliga a poner el path de la URL para reedirigir, con el método puedo usar el helper route()
    protected function redirectTo() {
        return route("home");
    }
}
