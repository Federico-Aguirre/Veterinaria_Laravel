<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;

class VerTurnoControlador extends Controller
{
    // Muestra la vista con los turnos disponibles
    public function index()
    {
        $turnos = TurnoModel::where('id_user', Auth::id())->get();
        return view('ver_turno', compact('turnos'));
    }
}