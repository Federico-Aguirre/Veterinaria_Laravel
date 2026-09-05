<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class BorrarMascota extends Component
{
    public $mascota_id;

    public function borrarMascota()
    {
        $mascota = MascotaModel::where('id_user', Auth::id())
                               ->where('id', $this->mascota_id)
                               ->first();

        if (!$mascota) {
            $this->dispatch('mascota-error', message: 'Mascota no encontrada o no pertenece al usuario.');
            return;
        }

        $mascota->delete();

        $this->dispatch('mascota-borrada', message: 'Mascota eliminada correctamente.');
        $this->reset('mascota_id');
    }

    public function render()
    {
        $mascotas = MascotaModel::where('id_user', Auth::id())->get();

        return view('livewire.borrar-mascota', [
            'mascotas' => $mascotas,
        ]);
    }
}