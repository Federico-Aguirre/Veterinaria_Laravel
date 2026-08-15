<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;

class VerTurno extends Component
{
    public $turnos;
    public $turnoSeleccionado = null;

    public function mount()
    {
        $this->turnos = TurnoModel::where('id_user', Auth::id())
                                  ->orderBy('fecha', 'desc')
                                  ->get();
    }

public $alerta = null;

public function mostrarTurno()
{
    if (!$this->turnoSeleccionado) {
        $this->alerta = 'Por favor selecciona un turno';
        return;
    }

    $t = $this->turnos->firstWhere('id', $this->turnoSeleccionado);
    if (!$t) {
        $this->alerta = 'Turno no válido';
        return;
    }

    $this->alerta = "Fecha: {$t->fecha}\nAsunto: {$t->asunto}\nMensaje: {$t->mensaje}";
}


    public function render()
    {
        return view('livewire.ver-turno');
    }
}
