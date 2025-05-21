<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerProductoControlador extends Controller
{
    public function apiProductos($categoria = null)
    {
        $ruta = storage_path('app/json/productos.json');
        $productos = json_decode(file_get_contents($ruta), true);
    
        // Filtrar por categoría si es necesario
        if ($categoria) {
            $productos = array_filter($productos, fn($p) => $p['categoria'] === $categoria);
        }
    
        return response()->json(array_values($productos));
    }    

    public function mostrarProductos($categoria = null)
    {
        $ruta = storage_path('app/json/productos.json');
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
