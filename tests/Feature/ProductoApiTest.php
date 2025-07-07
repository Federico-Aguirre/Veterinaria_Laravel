<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    public function test_api_productos_devuelve_codigo_200()
    {
        // Ruta al archivo JSON
        $jsonPath = resource_path('json/productos.json');

        // Crear archivo temporal si no existe
        if (!file_exists($jsonPath)) {
            File::ensureDirectoryExists(resource_path('json'));
            $productosFake = [
                [
                    "id" => 1,
                    "nombre" => "Collar para perro",
                    "precio" => 100,
                    "categoria" => "accesorios"
                ],
                [
                    "id" => 2,
                    "nombre" => "Alimento para gato",
                    "precio" => 200,
                    "categoria" => "alimentos"
                ]
            ];
            File::put($jsonPath, json_encode($productosFake));
        }

        // Hacer petición a la API
        $response = $this->get('/api/productos');

        // Verificar código de estado
        $response->assertStatus(200);

        // Verificar que es un JSON con al menos un producto
        $response->assertJsonStructure([
            '*' => ['id', 'nombre', 'precio', 'categoria']
        ]);
    }

    public function test_api_productos_devuelve_404_si_no_existe_el_json()
    {
        // Renombrar archivo si existe
        $jsonPath = resource_path('json/productos.json');
        $backupPath = $jsonPath . '.bak';

        if (file_exists($jsonPath)) {
            rename($jsonPath, $backupPath);
        }

        // Hacer petición
        $response = $this->get('/api/productos');

        // Verificar 404
        $response->assertStatus(404);

        // Restaurar archivo
        if (file_exists($backupPath)) {
            rename($backupPath, $jsonPath);
        }
    }
}