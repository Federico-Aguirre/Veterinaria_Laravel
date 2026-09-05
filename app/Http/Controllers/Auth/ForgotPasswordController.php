<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Mostrar el formulario para solicitar un enlace de restablecimiento de contraseña.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Vista para el formulario de solicitud
    }

    /**
     * Enviar el enlace de restablecimiento de contraseña al correo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validación del correo electrónico
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Intentar enviar el enlace de restablecimiento
        $response = Password::sendResetLink(
            $request->only('email')
        );

        // Verificar si el enlace fue enviado correctamente
        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', 'Enlace de restablecimiento de contraseña enviado.')
                    : back()->withErrors(['email' => 'Hubo un problema al enviar el enlace de recuperación.']);
    }
}