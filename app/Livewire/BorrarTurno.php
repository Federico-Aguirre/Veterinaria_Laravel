<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;

class BorrarTurno extends Component
{
    public $turnos;
    public $turnoSeleccionado = null;
    public $alerta = null;

    public function mount()
    {
        $this->cargarTurnos();
    }

    public function cargarTurnos()
    {
        $this->turnos = TurnoModel::where('id_user', Auth::id())
                                  ->orderBy('fecha', 'desc')
                                  ->get();
    }

    public function borrarTurno()
    {
        if (!$this->turnoSeleccionado) {
            $this->alerta = 'Por favor, selecciona un turno para borrar.';
            return;
        }

        $turno = $this->turnos->firstWhere('id', $this->turnoSeleccionado);

        if (!$turno) {
            $this->alerta = 'No tienes permiso para borrar este turno.';
            return;
        }

        $turno->delete();
        $this->alerta = 'Turno eliminado con éxito.';
        $this->turnoSeleccionado = null;

        $this->cargarTurnos(); // refresca la lista
    }

    public function render()
    {
        return view('livewire.borrar-turno');
    }
}