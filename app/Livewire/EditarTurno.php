<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TurnoModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EditarTurno extends Component
{
    public $turnos = [];
    public $turnoSeleccionado = null;
    public $fecha = '';
    public $asunto = '';
    public $mensaje = '';
    public $confirmado = false;

    public function mount()
    {
        $this->turnos = TurnoModel::where('id_user', Auth::id())->orderBy('fecha', 'desc')->get();
    }

public function seleccionarTurno()
{
    if (!$this->turnoSeleccionado) {
        $this->dispatch('alerta', mensaje: 'Elegí un turno.');
        return;
    }

    $t = TurnoModel::where('id_user', Auth::id())->find($this->turnoSeleccionado);

    if (!$t) {
        $this->dispatch('alerta', mensaje: 'Turno no válido.');
        return;
    }

    $this->fecha   = Carbon::parse($t->fecha)->format('Y-m-d\TH:i');
    $this->asunto  = $t->asunto;
    $this->mensaje = $t->mensaje;
    $this->confirmado = true;
}

public function actualizar()
{
    $this->validate([
        'fecha'   => 'required|date_format:Y-m-d H:i',
        'asunto'  => 'required|string|max:255',
        'mensaje' => 'nullable|string|max:255',
    ]);

    $turno = TurnoModel::where('id_user', Auth::id())->find($this->turnoSeleccionado);

    if (!$turno) {
        $this->dispatch('alerta', mensaje: 'No tienes permiso para editar este turno.');
        return;
    }

    $turno->fecha   = $this->fecha;
    $turno->asunto  = $this->asunto;
    $turno->mensaje = $this->mensaje;
    $turno->save();

    $this->dispatch('alerta', mensaje: 'Turno actualizado con éxito.');
    $this->reset(['turnoSeleccionado','fecha','asunto','mensaje','confirmado']);
    $this->turnos = TurnoModel::where('id_user', Auth::id())->orderBy('fecha', 'desc')->get();
}


    public function render()
    {
        return view('livewire.editar-turno');
    }
}