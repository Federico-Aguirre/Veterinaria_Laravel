<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurnoModel;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class AgregarTurnoControlador extends Controller
{
    // Muestra el formulario de agregar turno con las mascotas disponibles
    public function create()
    {
        // Obtener las mascotas del usuario autenticado
        $mascotas = MascotaModel::where('Id_user', Auth::id())->get();

        return view('agregar_turno', compact('mascotas'));
    }

    // En el controlador AgregarTurnoControlador
    public function verificarTurno(Request $request)
    {
        $fecha = $request->input('fecha');

        // Verificar si ya existe un turno en esa fecha
        $existeTurno = TurnoModel::where('Fecha', $fecha)->exists();

        return response()->json(['ocupado' => $existeTurno]);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'Fecha' => 'required|string|max:255',
            'Asunto' => 'required|string|max:255',
            'Mensaje' => 'required|string|max:255',
            'Id_mascota' => 'required|exists:mascotas,id', // Asegúrate de que la mascota exista
        ]);
    
        // Crear el turno y asociarlo al usuario autenticado
        $turno = new TurnoModel();
        $turno->Id_user = Auth::id(); // Asignar el usuario autenticado
        $turno->Fecha = $validated['Fecha']; // Asignar la fecha
        $turno->Id_mascota = $validated['Id_mascota']; // Asignar la mascota seleccionada
        $turno->Asunto = $validated['Asunto']; // Asunto
        $turno->Mensaje = $validated['Mensaje']; // Mensaje
    
        // Guardar el turno
        $turno->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('agregar_turno_formulario')->with('turno_creado_exitosamente', 'Turno creado exitosamente');
    }     
}