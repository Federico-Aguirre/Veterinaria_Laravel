<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // Muestra el formulario para restablecer la contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Maneja el restablecimiento de la contraseña
    public function reset(Request $request)
    {
        // Aquí estamos utilizando el método validate para validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        // Intentamos resetear la contraseña
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('cambio_de_contraseña_exitoso', 'Contraseña restablecida exitosamente');
        } else {
            return back()->withErrors(['email' => [trans($response)]]);
        }
    }
}
