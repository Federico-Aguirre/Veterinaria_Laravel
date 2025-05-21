<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BorrarPerfilControlador extends Controller
{
    public function borrar()
    {
        $user = User::find(Auth::id());

        if ($user) {
            $user->delete(); // Borra el perfil del usuario
            return response()->json(['message' => 'Perfil borrado exitosamente.']);
        }

        return response()->json(['message' => 'Usuario no encontrado.'], 404);
    }
}