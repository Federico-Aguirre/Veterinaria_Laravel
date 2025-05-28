<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditarPerfilControlador extends Controller
{
    // Muestra el formulario de edición
    public function editar()
    {
        return view('editar_perfil');
    }

    // Actualiza el perfil del usuario
    public function actualizar(Request $request)
    {
        // Recuperar el usuario autenticado
        $user = User::find(Auth::id());

        // Validación de los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'Apellido' => 'required|string|max:255',
            'Dirección' => 'required|string|max:255',
            'Piso' => 'required|integer',
            'Departamento' => 'required|string|max:255',
            'Localidad' => 'required|string|max:255',
            'Teléfono' => 'required|string|max:255',
            'Celular' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
        ]);

        // Actualizar el usuario
        $user->update([
            'name' => $request->input('name'),
            'apellido' => $request->input('Apellido'),
            'direccion' => $request->input('DirecciOn'),
            'piso' => $request->input('Piso'),
            'departamento' => $request->input('Departamento'),
            'localidad' => $request->input('Localidad'),
            'telefono' => $request->input('Teléfono'),
            'celular' => $request->input('Celular'),
            'email' => $request->input('Email'),
        ]);

        return redirect()->route('editar_perfil')->with('edición_de_usuario_exitoso', 'Perfil actualizado correctamente');
    }
}