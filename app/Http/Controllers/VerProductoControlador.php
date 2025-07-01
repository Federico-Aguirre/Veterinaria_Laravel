<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModel;


class VerProductoControlador extends Controller
{
    public function apiProductos($categoria = null, Request $request) {
        $busqueda = $request->query('q');

        $productos = ProductoModel::query();

        if ($categoria) {
            $productos->where('categoria', $categoria);
        }

        if ($busqueda) {
            $productos->where('descripcion', 'like', '%' . $busqueda . '%');
        }

        return response()->json($productos->get());
    }


    public function mostrarProductos($categoria = null)
    {
        $ruta = resource_path('json/productos.json');
        $contenido = file_get_contents($ruta);
        $productos = json_decode($contenido, true);

        // Si hay una categoría, filtramos
        if ($categoria) {
            $productos = array_filter($productos, function ($producto) use ($categoria) {
                return strtolower($producto['categoria']) === strtolower($categoria);
            });
        }

        // Convertimos el array a índices numerados
        $productos = array_values($productos);

        // Enviamos los productos a la vista
        return view('ver_productos', compact('productos', 'categoria'));
    }
  
}
