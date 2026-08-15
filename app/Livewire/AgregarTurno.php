<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TurnoModel;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class AgregarTurno extends Component
{
    public $fecha;
    public $id_mascota;
    public $asunto;
    public $mensaje;

    protected $rules = [
        'fecha' => 'required|date',
        'id_mascota' => 'required|exists:mascotas,id',
        'asunto' => 'required|string|max:255',
        'mensaje' => 'required|string|max:255',
    ];

    public function mount()
    {
        // 1. Validar que el usuario esté autenticado
        if (!Auth::check()) {
            session()->flash('alert', 'Debes iniciar sesión para solicitar un turno.');
            return redirect()->to('/login');
        }

        // 2. Validar que tenga al menos una mascota registrada
        $mascotas = MascotaModel::where('id_user', Auth::id())->get();

        if ($mascotas->isEmpty()) {
            session()->flash('alert', 'Debes registrar al menos una mascota para poder solicitar un turno.');
            session()->put('redirect_after_mascota', '/agregar_turno');

            return redirect()->to('/agregar_mascota');
        }
    }

    public function guardarTurno()
    {
        $this->validate();

        $mascota = MascotaModel::findOrFail($this->id_mascota);

        TurnoModel::create([
            'id_user' => Auth::id(),
            'fecha' => $this->fecha,
            'id_mascota' => $this->id_mascota,
            'mascota_nombre' => $mascota->nombre,
            'asunto' => $this->asunto,
            'mensaje' => $this->mensaje,
        ]);

        $this->reset(['fecha', 'id_mascota', 'asunto', 'mensaje']);

        // Emite el evento que Alpine.js captura para mostrar la alerta
        $this->dispatch('turno-creado', message: 'Turno creado exitosamente');
    }

    public function render()
    {
        return view('livewire.agregar-turno', [
            'mascotas' => Auth::check() 
                ? MascotaModel::where('id_user', Auth::id())->get() 
                : collect()
        ]);
    }
}