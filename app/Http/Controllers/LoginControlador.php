<?php

namespace App\Http\Controllers;

use App\Models\User;  // Importar el modelo User
use App\Models\CarroDeComprasModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogInControlador extends Controller
{
    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $credentials = $request->only('usuario', 'password');

        // Verificación de las credenciales
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            // Al loguearse correctamente, obtener la cantidad total de productos en el carrito
            $cantidadDeProductosEnCarro = CarroDeComprasModel::where('id_cliente', Auth::id())->sum('producto_cantidad');

            // Guardar la cantidad en la sesión
            session(['cantidadDeProductosEnCarro' => $cantidadDeProductosEnCarro]);

            // Redirigir al home después del login con un mensaje de éxito
            return redirect()->route('home')->with('login_exitoso', 'Usuario registrado exitosamente.');
        } else {
            // Si las credenciales son incorrectas, redirigir de vuelta con error
            return back()->with('login_error', 'Credenciales incorrectas. Intente nuevamente.');
        }
    }
}
