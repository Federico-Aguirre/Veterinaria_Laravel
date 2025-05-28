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
            'apellido' => $user->Apellido,
            'direccion' => $user->Dirección,
            'piso' => $user->Piso,
            'departamento' => $user->Departamento,
            'localidad' => $user->Localidad,
            'telefono' => $user->Teléfono,
            'celular' => $user->Celular,
            'email' => $user->email,
        ]);
    }
}