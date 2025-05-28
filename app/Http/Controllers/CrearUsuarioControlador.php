<?php
namespace App\Http\Controllers;

use App\Models\CrearUsuarioModel;
use Illuminate\Http\Request;

class CrearUsuarioControlador extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:users,DNI',
            'cuil_cuit' => 'nullable|numeric|unique:users,CUIL_CUIT',
            'address' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'locality' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'cellphone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'username' => 'required|string|unique:users,Usuario|max:255',
            'password' => 'required|string|min:1',  // Asegúrate de que la contraseña tenga al menos 8 caracteres
        ]);

        // Crear un nuevo usuario en la base de datos
        $usuario = CrearUsuarioModel::create([
            'name' => $request->name,
            'apellido' => $request->surname,
            'dni' => $request->dni,
            'cuil_cuit' => $request->cuil_cuit,
            'direccion' => $request->address,
            'piso' => $request->floor,
            'departamento' => $request->department,
            'localidad' => $request->locality,
            'telefono' => $request->phone,
            'celular' => $request->cellphone,
            'email' => $request->email,
            'usuario' => $request->username,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]);

        // Verificar si el usuario se guardó
        if ($usuario) {
            // pasa el mensaje al archivo login o registrarse
            return redirect()->route('login')->with('registro_de_usuario_exitoso', 'Usuario registrado exitosamente.');
        } else {
            return back()->with('registro_de_usuario_error', 'Hubo un problema al registrar al usuario.');
        }
    }
}
