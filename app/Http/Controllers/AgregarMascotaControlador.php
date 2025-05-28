<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class AgregarMascotaControlador extends Controller
{
    // Método para crear una mascota
    public function store(Request $request)
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

        // Crear la mascota y asociarla al usuario autenticado
        $mascota = new MascotaModel([
            'nombre' => $validated['Nombre'],
            'raza' => $validated['Raza'],
            'sexo' => $validated['Sexo'],
            'edad' => $validated['Edad'],
            'cro_de_microchip' => empty($validated['Nro_de_microchip']) ? null : $validated['Nro_de_microchip'], // si es nulo lo transformo en null, de no ser el caso le paso el valor escrito en el formulario
            'vacuna_antirrábica' => empty($validated['Vacuna_antirrábica']) ? null : $validated['Vacuna_antirrábica'],
            'tratamiento_antiparasitario' => empty($validated['Tratamiento_antiparasitario']) ? null : $validated['Tratamiento_antiparasitario'],
            'otras_vacunas' => empty($validated['Otras_vacunas']) ? null : $validated['Otras_vacunas'],
            'informacion_adicional' => empty($validated['Información_adicional']) ? null : $validated['Información_adicional'],
            'id_user' => Auth::id(),
        ]);

        // Asociar la mascota al usuario autenticado usando la relación
        $mascota->user()->associate(Auth::user());

        // Guardar la mascota
        $mascota->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('agregar_mascota')->with('mascota_creada_exitosamente', 'Mascota creada exitosamente');
    }
}