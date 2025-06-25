<?php

namespace App\Http\Controllers;

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

        // 👇 Indicamos explícitamente el campo usuario
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {
            
            $userId = Auth::id();

            /*$cantidad = CarroDeComprasModel::where('id_cliente', $userId)->sum('producto_cantidad');

            session(['cantidadDeProductosEnCarro' => $cantidad]);*/

            return redirect()->route('home')->with('login_exitoso', 'Login exitoso');
        }

        return back()->with('login_error', 'Credenciales incorrectas.');
    }
}
