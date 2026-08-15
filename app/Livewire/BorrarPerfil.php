<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BorrarPerfil extends Component
{
// Componente Livewire
public function borrarPerfil()
{
    $user = User::find(Auth::id());

    if ($user) {
        $user->delete();
        Auth::logout();

        // Redirige directamente, sin alert (el alert ya se mostró antes)
        redirect()->route('login');
    }
}


    public function render()
    {
        return view('livewire.borrar-perfil');
    }
}
