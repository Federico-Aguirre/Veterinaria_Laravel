<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class VerMascota extends Component
{
    public $mascota_id;

    public function verMascota()
    {
        $mascota = MascotaModel::where('id_user', Auth::id())
                               ->where('id', $this->mascota_id)
                               ->first();

        if (!$mascota) {
            $this->dispatch('mascota-error', message: 'Mascota no encontrada o no pertenece al usuario.');
            return;
        }

        // Emitir evento con los datos de la mascota
        $this->dispatch('mostrar-mascota', mascota: [
            'nombre' => $mascota->nombre,
            'raza' => $mascota->raza,
            'sexo' => $mascota->sexo,
            'edad' => $mascota->edad,
            'microchip' => $mascota->nro_de_microchip,
            'vacuna' => $mascota->vacuna_antirrabica ? 'Sí' : 'No',
            'antiparasitario' => $mascota->tratamiento_antiparasitario ? 'Sí' : 'No',
            'otras_vacunas' => $mascota->otras_vacunas,
            'informacion_adicional' => $mascota->informacion_adicional,
        ]);
    }

    public function render()
    {
        $mascotas = MascotaModel::where('id_user', Auth::id())->get();

        return view('livewire.ver-mascota', [
            'mascotas' => $mascotas,
        ]);
    }
}