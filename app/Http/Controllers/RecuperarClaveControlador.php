<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\RecuperarClaveModel;

class RecuperarClaveControlador extends Controller
{
    public function mostrarFormulario()
    {
        return view('recuperar_clave');
    }

    public function enviar(Request $request)
    {
        // Validar el correo electrónico
        $request->validate([
            'email' => 'required|email|exists:users,email', // Asegurarse que el correo exista en la base de datos
        ]);

        // Intentar enviar el enlace de recuperación de contraseña
        $response = Password::sendResetLink(
            $request->only('email')
        );

        // Verificar la respuesta
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('recuperación_de_clave_exitoso', 'Hemos enviado un enlace para restablecer tu contraseña.');
        } else {
            return back()->with('recuperación_de_clave_exitoso', 'Hubo un error al enviar el enlace de recuperación.');
        }
    }
}
