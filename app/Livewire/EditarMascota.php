<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class EditarMascota extends Component
{
    public $mascotaId;
    public $mascota;

    public $nombre, $raza, $sexo, $edad, $nro_de_microchip;
    public $vacuna_antirrabica = false;
    public $tratamiento_antiparasitario = false;
    public $otras_vacunas, $informacion_adicional;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'raza' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'edad' => 'required|integer|min:0',
        'nro_de_microchip' => 'nullable|string|max:255',
        'vacuna_antirrabica' => 'boolean',
        'tratamiento_antiparasitario' => 'boolean',
        'otras_vacunas' => 'nullable|string|max:255',
        'informacion_adicional' => 'nullable|string|max:255',
    ];

    public function mount($mascotaId = null)
    {
        if ($mascotaId) {
            $this->cargarMascota($mascotaId);
        }
    }

    public function cargarMascota($id)
    {
        $this->mascota = MascotaModel::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $this->mascotaId = $this->mascota->id;
        $this->nombre = $this->mascota->nombre;
        $this->raza = $this->mascota->raza;
        $this->sexo = $this->mascota->sexo;
        $this->edad = $this->mascota->edad;
        $this->nro_de_microchip = $this->mascota->nro_de_microchip;
        $this->vacuna_antirrabica = $this->mascota->vacuna_antirrabica;
        $this->tratamiento_antiparasitario = $this->mascota->tratamiento_antiparasitario;
        $this->otras_vacunas = $this->mascota->otras_vacunas;
        $this->informacion_adicional = $this->mascota->informacion_adicional;
    }

    public function actualizarMascota()
    {
        $this->validate();

        $this->mascota->update([
            'nombre' => $this->nombre,
            'raza' => $this->raza,
            'sexo' => $this->sexo,
            'edad' => $this->edad,
            'nro_de_microchip' => $this->nro_de_microchip,
            'vacuna_antirrabica' => $this->vacuna_antirrabica,
            'tratamiento_antiparasitario' => $this->tratamiento_antiparasitario,
            'otras_vacunas' => $this->otras_vacunas,
            'informacion_adicional' => $this->informacion_adicional,
        ]);

        $this->dispatch('mascota-actualizada', message: 'Mascota actualizada exitosamente');
    }

    public function render()
    {
        $mascotas = MascotaModel::where('id_user', Auth::id())->get();

        return view('livewire.editar-mascota', [
            'mascotas' => $mascotas,
        ]);
    }
}