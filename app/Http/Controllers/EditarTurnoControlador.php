<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;

class EditarTurnoControlador extends Controller
{
    // Muestra la vista para seleccionar o editar un turno
    public function create(Request $request)
    {
        // Obtener todos los turnos del usuario autenticado
        $turnos = TurnoModel::where('Id_user', Auth::id())->get();

        // Verificar si se ha seleccionado un turno para editar
        $turnoSeleccionado = null;
        if ($request->has('id')) {
            $turnoSeleccionado = TurnoModel::where('Id_user', Auth::id())->find($request->id);
        }

        return view('editar_turno', compact('turnos', 'turnoSeleccionado'));
    }

    // Actualiza un turno existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'Fecha' => 'required|date_format:Y-m-d\TH:i',
            'Asunto_a_atender' => 'required|string|max:255',
            'Mensaje' => 'nullable|string|max:255',
        ]);

        // Buscar el turno a editar
        $turno = TurnoModel::where('Id_user', Auth::id())->find($id);

        // Verificar si el turno existe y pertenece al usuario autenticado
        if (!$turno) {
            return redirect()->route('editar_turno')->with('error', 'No tienes permiso para editar este turno.');
        }

        // Actualizar los datos del turno
        $turno->Fecha = $validated['Fecha'];
        $turno->Asunto = $validated['Asunto_a_atender'];
        $turno->Mensaje = $validated['Mensaje'];

        // Guardar los cambios
        $turno->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('editar_turno')->with('Turno_actualizado', 'Turno actualizado con éxito.');
    }
}