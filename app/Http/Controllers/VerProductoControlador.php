<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoModel;


class VerProductoControlador extends Controller
{
    public function apiProductos($categoria = null)
    {
        $path = resource_path('json/productos.json');

        if (!file_exists($path)) {
            return response()->json([], 404);
        }

        $contenido = file_get_contents($path);
        $productos = json_decode($contenido, true);

        if (!is_array($productos)) {
            return response()->json([], 500);
        }

        if ($categoria) {
            // Normalizamos la categoría para que coincida
            $categoria = strtolower($categoria);
            $productos = array_filter($productos, function ($producto) use ($categoria) {
                return strtolower($producto['categoria']) === $categoria;
            });
            $productos = array_values($productos); // Reindexar
        }

        return response()->json($productos);
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
