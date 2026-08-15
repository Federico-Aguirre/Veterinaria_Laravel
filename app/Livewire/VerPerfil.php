<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VerPerfil extends Component
{
    public function mostrar()
    {
        $user = Auth::user();

        $perfil = "
Nombre: {$user->name}
Apellido: {$user->apellido}
Dirección: {$user->direccion}
Piso: {$user->piso}
Departamento: {$user->departamento}
Localidad: {$user->localidad}
Teléfono: {$user->telefono}
Celular: {$user->celular}
Email: {$user->email}
        ";

        // Enviamos el mensaje como un simple string
        $this->dispatch('mostrar-alerta', message: $perfil);
    }

    public function render()
    {
        return view('livewire.ver-perfil');
    }
}
