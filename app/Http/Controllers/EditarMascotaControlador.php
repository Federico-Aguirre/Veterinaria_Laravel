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
            'Vacuna_antirrabica' => 'nullable|boolean',
            'Tratamiento_antiparasitario' => 'nullable|boolean',
            'Otras_vacunas' => 'nullable|string|max:255',
            'Información_adicional' => 'nullable|string|max:255',
        ]);

        // Buscar la mascota por ID
        $mascota = MascotaModel::findOrFail($id);

        // Actualizar los campos de la mascota
        $mascota->nombre = $validated['Nombre'];
        $mascota->raza = $validated['Raza'];
        $mascota->sexo = $validated['Sexo'];
        $mascota->edad = $validated['Edad'];
        $mascota->nro_de_microchip = $validated['Nro_de_microchip'];
        $mascota->vacuna_antirrabica = $validated['Vacuna_antirrabica'] ?? null;
        $mascota->tratamiento_antiparasitario = $validated['Tratamiento_antiparasitario'] ?? null;
        $mascota->otras_vacunas = $validated['Otras_vacunas'];
        $mascota->informacion_adicional = $validated['Información_adicional'];

        // Guardar los cambios
        $mascota->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('editar_mascota_formulario', ['id' => $mascota->id])
        ->with('mascota_actualizada_exitosamente', 'Mascota actualizada exitosamente');
    }
}
