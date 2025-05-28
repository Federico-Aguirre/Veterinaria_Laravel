<?php

namespace App\Http\Controllers;

use App\Models\User;  // Importar el modelo User
use App\Models\CarroDeComprasModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogInControlador extends Controller
{
    public function login(Request $request) {
        $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 👇 VERIFICACIÓN para evitar error de tipo si id es null o string
            $userId = $user->id;

            if (!is_numeric($userId)) {
                return back()->with('login_error', 'Error interno: ID de usuario inválido');
            }

            // Consulta segura
            $cantidad = \App\Models\CarroDeComprasModel::where('id_cliente', (int)$userId)->sum('producto_cantidad');

            session(['cantidadDeProductosEnCarro' => $cantidad]);

            return redirect()->route('home')->with('login_exitoso', 'Login exitoso');
        }
    }
}
