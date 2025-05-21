<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ComprasRealizadasModel;
use App\Models\CarroDeComprasModel;
use Carbon\Carbon;

class ComprasRealizadasControlador extends Controller
{
    public function procesarCompra()
    {
        $usuarioId = Auth::id();
        $productos = CarroDeComprasModel::where('id_cliente', $usuarioId)->get();

        if ($productos->isEmpty()) {
            return redirect()->back()->with('error', 'No hay productos en el carrito.');
        }

        foreach ($productos as $producto) {
            ComprasRealizadasModel::create([
                'id_cliente' => $usuarioId,
                'producto_id' => $producto->producto_id,
                'producto_cantidad' => $producto->producto_cantidad,
                'producto_imagen' => $producto->producto_imagen,
                'producto_descripcion' => $producto->producto_descripcion,
                'producto_precio' => $producto->producto_precio,
                'producto_stock' => $producto->producto_stock,
                'producto_caracteristicas_1' => $producto->producto_caracteristicas_1,
                'producto_caracteristicas_2' => $producto->producto_caracteristicas_2,
                'producto_caracteristicas_3' => $producto->producto_caracteristicas_3,
                'producto_caracteristicas_4' => $producto->producto_caracteristicas_4,
                'producto_caracteristicas_5' => $producto->producto_caracteristicas_5,
                'producto_precio_total' => $producto->producto_precio_total,
                'fecha_de_compra' => Carbon::now(),
            ]);
        }

        // Vaciar el carrito
        CarroDeComprasModel::where('id_cliente', $usuarioId)->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('compras.realizadas')
        ]);        
    }

    public function mostrarCompras()
    {
        $usuarioId = Auth::id();
        $compras = ComprasRealizadasModel::where('id_cliente', $usuarioId)->orderBy('fecha_de_compra', 'desc')->get();

        return view('compras_realizadas', ['compras' => $compras]);
    }
}
