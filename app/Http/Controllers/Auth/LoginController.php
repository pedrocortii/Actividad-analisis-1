<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    
public function logout(Request $request)
{
    Auth::logout(); // Cierra la sesión activa del usuario

    $request->session()->invalidate(); // Invalida la sesión actual
    $request->session()->regenerateToken(); // Regenera el token de seguridad

    return redirect('/'); // Redirige al welcome.blade.php
}

protected function redirectTo()
{
    $user = auth()->user();

    // Hacemos la comprobación insensible a mayúsculas
    if ($user->hasRole('cliente') || $user->hasRole('Cliente')) {
        return '/clientes';
    }

    if ($user->hasRole('Admin')) {
        return '/home';
    }

    // Si tiene otro rol, por ejemplo "Empleado"
    if ($user->hasRole('Empleado')) {
        return '/home';
    }

    // Por defecto, si no tiene rol o algo falla:
    return '/home';
}
}