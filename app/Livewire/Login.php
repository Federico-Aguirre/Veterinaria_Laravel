<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CarroDeComprasModel;

class Login extends Component
{
    public $usuario;
    public $password;

    protected $rules = [
        'usuario' => 'required|string',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['usuario' => $this->usuario, 'password' => $this->password])) {
            
            $userId = Auth::id();
            $cantidad = CarroDeComprasModel::where('id_cliente', $userId)->sum('producto_cantidad');
            session(['cantidadDeProductosEnCarro' => $cantidad]);

            $this->dispatch('mostrar-alerta', message: 'Login exitoso');

            return redirect()->intended(route('home'));
        }

        $this->dispatch('mostrar-alerta', message: 'Credenciales incorrectas.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}