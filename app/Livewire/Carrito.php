<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarroDeComprasModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Carrito extends Component
{
    public $productos;
    public $cantidad;
    public $cantidadTotal;

    public function mount()
    {
        $this->actualizarCarrito();
    }

    public function actualizarCarrito()
    {
        if (Auth::check()) {
            $clienteId = Auth::id();

            // Trae todos los productos del carrito
            $this->productos = CarroDeComprasModel::where('id_cliente', $clienteId)->get();

            // Calcula la cantidad y total en una sola consulta optimizada
            $totales = CarroDeComprasModel::where('id_cliente', $clienteId)
                ->select(
                    DB::raw('SUM(producto_cantidad) as cantidad_total'),
                    DB::raw('SUM(producto_precio * producto_cantidad) as total_monetario')
                )
                ->first();

            $this->cantidad = $totales->cantidad_total ?? 0;
            $this->cantidadTotal = $totales->total_monetario ?? 0;
        } else {
            $this->productos = collect();
            $this->cantidad = 0;
            $this->cantidadTotal = 0;
        }
    }

    public function eliminar($id)
    {
        $producto = CarroDeComprasModel::where('id', $id)
                                        ->where('id_cliente', Auth::id())
                                        ->first();

        if ($producto) {
            $producto->delete();
            $this->actualizarCarrito();
        }
    }

    public function render()
    {
        return view('livewire.carrito');
    }
}
