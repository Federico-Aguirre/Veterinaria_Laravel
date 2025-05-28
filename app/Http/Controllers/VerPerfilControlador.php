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
            'apellido' => $user->apellido,
            'direccion' => $user->direccion,
            'piso' => $user->piso,
            'departamento' => $user->departamento,
            'localidad' => $user->localidad,
            'telefono' => $user->telefono,
            'celular' => $user->celular,
            'email' => $user->email,
        ]);
    }
}