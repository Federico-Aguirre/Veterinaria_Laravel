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
    public $perfilCompleto = false;

    public function mount()
    {
        $this->cargarProductos();

        // Verificar si hay usuario y validar perfil sin riesgo de error de propiedad nula
        if (Auth::check()) {
            $user = Auth::user();
            $this->perfilCompleto = (bool) (
                $user->name &&
                $user->apellido &&
                $user->email &&
                $user->direccion &&
                $user->departamento &&
                $user->localidad &&
                $user->dni &&
                $user->cuil_cuit &&
                $user->piso !== null
            );
        } else {
            $this->perfilCompleto = false;
        }
    }

    public function cargarProductos()
    {
        // Verifica que en tu proyecto la carpeta sea resources/json/productos.json (todo en minúsculas)
        $path = resource_path('json/productos.json');

        if (!File::exists($path)) {
            $this->productos = [];
            return;
        }

        $data = json_decode(File::get($path), true) ?? [];

        // Filtrar por categoría
        if ($this->categoria) {
            $data = array_filter($data, fn($p) => isset($p['categoria']) && $p['categoria'] === $this->categoria);
        }

        // Filtrar por búsqueda
        if ($this->busqueda) {
            $data = array_filter($data, fn($p) =>
                isset($p['descripcion']) && str_contains(strtolower($p['descripcion']), strtolower($this->busqueda))
            );
        }

        $this->productos = array_values($data);
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