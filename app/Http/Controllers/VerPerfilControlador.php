<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerPerfilControlador extends Controller
{
    public function mostrar()
    {
        // Recuperar los datos del usuario autenticado
        $user = Auth::user();

        // Retornar los datos como JSON
        return response()->json([
            'name' => $user->name,
            'Apellido' => $user->Apellido,
            'Dirección' => $user->Dirección,
            'Piso' => $user->Piso,
            'Departamento' => $user->Departamento,
            'Localidad' => $user->Localidad,
            'Teléfono' => $user->Teléfono,
            'Celular' => $user->Celular,
            'email' => $user->email,
        ]);
    }
}