<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoModel extends Model
{
    public static function getProductos()
    {
        $path = storage_path('app/json/productos.json');
        return self::getProductosFromFile($path);
    }

    public static function getProductosByCategory($categoria)
    {
        $path = storage_path('app/json/productos.json');
        $productos = self::getProductosFromFile($path);
        return isset($productos[$categoria]) ? $productos[$categoria] : [];
    }

    private static function getProductosFromFile($path)
    {
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $productos = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return [];
            }
            return $productos;
        }
        return [];
    }
}
