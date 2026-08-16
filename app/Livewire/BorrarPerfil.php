<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BorrarPerfil extends Component
{
public function borrarPerfil()
{
    $user = User::find(Auth::id());

    if ($user) {
        $user->delete();
        Auth::logout();
        redirect()->route('login');
    }
}


    public function render()
    {
        return view('livewire.borrar-perfil');
    }
}
