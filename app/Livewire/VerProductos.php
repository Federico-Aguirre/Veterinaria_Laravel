<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VerProductos extends Component
{
    public $productos = [];
    public $categoria = null;
    public $busqueda = '';
    public $perfilCompleto;


public function mount()
{
    $this->cargarProductos();

    $user = Auth::user();
    $this->perfilCompleto = Auth::check() &&
        $user->name &&
        $user->apellido &&
        $user->email &&
        $user->direccion &&
        $user->departamento &&
        $user->localidad &&
        $user->dni &&
        $user->cuil_cuit &&
        $user->piso !== null &&
        $user->created_at &&
        $user->updated_at;
}


    public function cargarProductos()
    {
        $path = resource_path('json/productos.json'); // Usar slash normal /

        if (!File::exists($path)) {
            $this->productos = [];
            return;
        }

        // Leer el archivo JSON directamente
        $data = json_decode(File::get($path), true);

        // Filtrar por categoría si existe
        if ($this->categoria) {
            $data = array_filter($data, fn($p) => $p['categoria'] === $this->categoria);
        }

        // Filtrar por búsqueda si existe
        if ($this->busqueda) {
            $data = array_filter($data, fn($p) =>
                str_contains(strtolower($p['descripcion']), strtolower($this->busqueda))
            );
        }

        $this->productos = array_values($data); // Reindexar el array
    }

    public function setCategoria($categoria = null)
    {
        $this->categoria = $categoria;
        $this->cargarProductos();
    }

    public function updatedBusqueda()
    {
        $this->cargarProductos();
    }

    public function render()
    {
        return view('livewire.ver-productos');
    }
}