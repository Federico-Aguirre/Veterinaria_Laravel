<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CrearUsuarioModel;
use Illuminate\Support\Facades\Hash;

class AgregarUsuario extends Component
{
    public $name;
    public $surname;
    public $dni;
    public $cuil_cuit;
    public $address;
    public $floor;
    public $department;
    public $locality;
    public $phone;
    public $cellphone;
    public $email;
    public $username;
    public $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'dni' => 'required|numeric|unique:users,dni',
        'cuil_cuit' => 'nullable|numeric|unique:users,cuil_cuit',
        'address' => 'required|string|max:255',
        'floor' => 'nullable|string|max:255',
        'department' => 'nullable|string|max:255',
        'locality' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'cellphone' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
        'username' => 'required|string|unique:users,usuario|max:255',
        'password' => 'required|string|min:1',
    ];

    public function agregar()
    {
        $validated = $this->validate();

        $usuario = CrearUsuarioModel::create([
            'name' => $validated['name'],
            'apellido' => $validated['surname'],
            'dni' => $validated['dni'],
            'cuil_cuit' => $validated['cuil_cuit'],
            'direccion' => $validated['address'],
            'piso' => $validated['floor'],
            'departamento' => $validated['department'],
            'localidad' => $validated['locality'],
            'telefono' => $validated['phone'],
            'celular' => $validated['cellphone'],
            'email' => $validated['email'],
            'usuario' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($usuario) {
            $this->dispatch('mostrar-alerta', message: 'Usuario registrado exitosamente.');
            return redirect()->route('login');
        } else {
            $this->dispatch('mostrar-alerta', message: 'Hubo un problema al registrar al usuario.');
        }
    }

    public function render()
    {
        return view('livewire.agregar-usuario');
    }
}