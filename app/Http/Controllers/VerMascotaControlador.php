<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class VerMascotaControlador extends Controller
{
    public function index()
    {
        // Verifica que el usuario esté autenticado antes de buscar mascotas
        if (Auth::check()) {
            $mascotas = MascotaModel::where('id_user', Auth::id())->get();
        } else {
            $mascotas = collect(); // Si no hay usuario autenticado, devolver colección vacía
        }
    
        return view('ver_mascota', compact('mascotas'));
    }    

    public function show($id)
    {
        // Obtener la mascota específica si pertenece al usuario autenticado
        $mascota = MascotaModel::where('id_user', Auth::id())->where('id', $id)->first();

        if (!$mascota) {
            return redirect()->route('ver_mascota')->with('error', 'Mascota no encontrada o no tienes permiso para verla.');
        }

        // Obtener todas las mascotas para el select también
        $mascotas = MascotaModel::where('id_user', Auth::id())->get();

        return view('ver_mascota', compact('mascota', 'mascotas'));
    }
}
