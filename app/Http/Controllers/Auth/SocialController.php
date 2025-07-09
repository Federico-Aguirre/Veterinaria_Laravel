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
        $socialUser = Socialite::driver($provider)->user();

        // Separar nombre y apellido si es posible
        $givenName = $socialUser->user['given_name'] ?? null;
        $familyName = $socialUser->user['family_name'] ?? null;

        // Buscar o crear el usuario
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $givenName ?? $socialUser->getName(),
                'apellido' => $familyName ?? '',
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'usuario' => 'google_' . Str::random(8),
                'piso' => 0,
                'departamento' => '',
                'direccion' => '',
                'localidad' => '',
                'telefono' => '',
                'celular' => '',
                'dni' => '',
                'cuil_cuit' => '',
            ]
        );

        Auth::login($user);

        // Verificar si faltan datos críticos
        if (empty($user->telefono) || empty($user->dni)) {
            return redirect('/completar-perfil');
        }

        return redirect('/home');
    }
}
