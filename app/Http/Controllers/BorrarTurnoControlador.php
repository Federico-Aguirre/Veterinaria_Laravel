<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;

class BorrarTurnoControlador extends Controller
{
    // Muestra la vista con los turnos disponibles para borrar
    public function index()
    {
        $turnos = TurnoModel::where('id_user', Auth::id())->get();
        return view('borrar_turno', compact('turnos'));
    }

    // Elimina el turno seleccionado
    public function destroy($id)
    {
        $turno = TurnoModel::where('id_user', Auth::id())->find($id);

        if (!$turno) {
            return redirect()->route('borrar_turno')->with('error', 'No tienes permiso para borrar este turno.');
        }

        $turno->delete();

        return redirect()->route('borrar_turno')->with('turno_eliminado', 'Turno eliminado con éxito.');
    }
}