<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use RealRashid\SweetAlert\Facades\Alert;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//     public function showLoginForm()
// {
    // Alert::info('Info Title', 'Info Message');
//     return view('auth.login');


// }

}



// public function showLoginForm()
// {
//     // Verificar si la cookie de recordatorio está presente
//     $mostrarRecordatorio = !request()->cookie('recordatorio_cerrado');

//     // Personalizar el mensaje que se mostrará en la vista
//     $mensaje = 'Debe registrarse para acceder al Sistema.';

//     return view('auth.login', compact('mensaje', 'mostrarRecordatorio'));
// }