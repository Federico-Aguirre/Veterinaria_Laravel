<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            dd('Error al obtener usuario socialite:', $e->getMessage());
        }

        // Obtener el usuario desde Google
        $socialUser = Socialite::driver($provider)->user();

        // Intentar extraer nombre y apellido
        $givenName = $socialUser->user['given_name'] ?? null;
        $familyName = $socialUser->user['family_name'] ?? '';

        // Verificar si ya existe un usuario con este email
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Crear el nuevo usuario con valores por defecto seguros
            $user = User::create([
                'name'         => $givenName ?? $socialUser->getName(),
                'apellido'     => $familyName,
                'email'        => $socialUser->getEmail(),
                'password'     => bcrypt(Str::random(16)), // Contraseña ficticia
                'usuario'      => 'google_' . Str::random(8),
                'piso'         => 0,
                'departamento' => '',
                'direccion'    => '',
                'localidad'    => '',
                'telefono'     => '',
                'celular'      => '',
                'dni'          => '',
                'cuil_cuit'    => '',
            ]);
        }

        // Loguear al usuario
        Auth::login($user);

        // Redirigir si faltan datos importantes
        if (empty($user->telefono) || empty($user->dni)) {
            return redirect('/editar_perfil')->with('alerta', 'Por favor, complete los datos restantes.');
        }

        return redirect('/home'); // Redirige al home si todo está bien
    }
}