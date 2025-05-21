<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MascotaModel;

class EditarMascotaControlador extends Controller
{
    // Método para mostrar el formulario con el select para elegir una mascota
    public function index()
    {
        // Obtener todas las mascotas disponibles para el select
        $mascotas = MascotaModel::all();
        
        // Retornar la vista con las mascotas disponibles
        return view('editar_mascota', compact('mascotas'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        // Buscar la mascota por ID
        $mascota = MascotaModel::find($id);
        
        // Retornar la vista con los datos de la mascota
        return view('editar_mascota', compact('mascota'));
    }

    // Método para actualizar los datos de la mascota
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Raza' => 'required|string|max:255',
            'Sexo' => 'required|string|max:255',
            'Edad' => 'required|integer|min:0',
            'Nro_de_microchip' => 'nullable|string|max:255',
            'Vacuna_antirrábica' => 'nullable|boolean',
            'Tratamiento_antiparasitario' => 'nullable|boolean',
            'Otras_vacunas' => 'nullable|string|max:255',
            'Información_adicional' => 'nullable|string|max:255',
        ]);

        // Buscar la mascota por ID
        $mascota = MascotaModel::findOrFail($id);

        // Actualizar los campos de la mascota
        $mascota->Nombre = $validated['Nombre'];
        $mascota->Raza = $validated['Raza'];
        $mascota->Sexo = $validated['Sexo'];
        $mascota->Edad = $validated['Edad'];
        $mascota->Nro_de_microchip = $validated['Nro_de_microchip'];
        $mascota->Vacuna_antirrábica = $validated['Vacuna_antirrábica'] ?? null;
        $mascota->Tratamiento_antiparasitario = $validated['Tratamiento_antiparasitario'] ?? null;
        $mascota->Otras_vacunas = $validated['Otras_vacunas'];
        $mascota->Información_adicional = $validated['Información_adicional'];

        // Guardar los cambios
        $mascota->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('editar_mascota_formulario', ['id' => $mascota->id])
        ->with('mensaje', 'Mascota actualizada exitosamente');
    }
}
