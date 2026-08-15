<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EditarPerfil extends Component
{
    public $name, $apellido, $direccion, $piso, $departamento, $localidad, $telefono, $celular, $email;
    public $alertMessage;

    public function mount()
    {
        $user = Auth::user();

        if ($user) {
            $this->name = $user->name;
            $this->apellido = $user->apellido;
            $this->direccion = $user->direccion;
            $this->piso = $user->piso;
            $this->departamento = $user->departamento;
            $this->localidad = $user->localidad;
            $this->telefono = $user->telefono;
            $this->celular = $user->celular;
            $this->email = $user->email;
        }
    }

    public function actualizarPerfil()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'piso' => 'required|integer',
            'departamento' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::find(Auth::id());

        if (!$user) {
            $this->alertMessage = "Error: usuario no autenticado.";
            return;
        }

        $user->update($validated);

        // Mostramos alerta con Alpine
        $this->alertMessage = "Perfil actualizado correctamente.";
    }

    public function render()
    {
        return view('livewire.editar-perfil');
    }
}
