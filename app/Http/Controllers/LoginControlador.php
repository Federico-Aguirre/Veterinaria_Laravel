<?php

namespace App\Http\Controllers;

use App\Models\User;  // Importar el modelo User
use App\Models\CarroDeComprasModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogInControlador extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('usuario', 'password');

        if (Auth::attempt($credentials)) {
            $userId = Auth::id();

            $cantidadDeProductosEnCarro = CarroDeComprasModel::where('id_cliente', $userId)->sum('producto_cantidad');

            session(['cantidadDeProductosEnCarro' => $cantidadDeProductosEnCarro]);

            return redirect()->route('home')->with('login_exitoso', 'Usuario registrado exitosamente.');
        } else {
            return back()->with('login_error', 'Credenciales incorrectas. Intente nuevamente.');
        }
    }
}
