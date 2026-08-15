<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MascotaModel;
use Illuminate\Support\Facades\Auth;

class AgregarMascota extends Component
{
    public $nombre;
    public $raza;
    public $sexo;
    public $edad;
    public $nro_de_microchip;
    public $vacuna_antirrabica = false;
    public $tratamiento_antiparasitario = false;
    public $otras_vacunas;
    public $informacion_adicional;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'raza' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'edad' => 'required|integer|min:0',
    ];

    public function guardarMascota()
{
    $this->validate();

    MascotaModel::create([
        'id_user' => Auth::id(),
        'nombre' => $this->nombre,
        'raza' => $this->raza,
        'sexo' => $this->sexo,
        'edad' => $this->edad,
        'nro_de_microchip' => $this->nro_de_microchip,
        'vacuna_antirrabica' => $this->vacuna_antirrabica,
        'tratamiento_antiparasitario' => $this->tratamiento_antiparasitario,
        'otras_vacunas' => $this->otras_vacunas,
        'informacion_adicional' => $this->informacion_adicional,
    ]);

    // 💡 Verificamos si venía de intentar sacar un turno
    if (session()->has('redirect_after_mascota')) {
        $destino = session('redirect_after_mascota');
        session()->forget('redirect_after_mascota');
        session()->flash('success', '¡Mascota registrada exitosamente! Ahora puedes solicitar tu turno.');
    } else {
        $destino = '/';
        session()->flash('success', '¡Mascota creada con éxito!');
    }

    return redirect()->to($destino);
}

    public function render()
    {
        return view('livewire.agregar-mascota');
    }
}