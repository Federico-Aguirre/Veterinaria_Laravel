<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MascotaModel;

class BorrarMascotaControlador extends Controller
{
    public function index()
    {
        $mascotas = MascotaModel::all();
        return view('borrar_mascota', compact('mascotas'));
    }

    public function destroy($id)
    {
        $mascota = MascotaModel::find($id);

        if (!$mascota) {
            return response()->json(['error' => 'Mascota no encontrada'], 404);
        }

        $mascota->delete();

        return response()->json(['success' => 'Mascota eliminada correctamente']);
    }
}