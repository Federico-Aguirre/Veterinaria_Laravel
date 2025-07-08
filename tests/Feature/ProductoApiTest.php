<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    /** @test */
    public function el_json_de_productos_es_valido()
    {
        // Ruta absoluta al archivo JSON en resources/json/productos.json
        $ruta = resource_path('json/productos.json');

        // Verificamos que el archivo exista
        $this->assertFileExists($ruta, 'El archivo productos.json no se encontró en resources/json.');

        // Cargamos y decodificamos el contenido
        $contenido = file_get_contents($ruta);
        $data = json_decode($contenido, true);

        // Verificamos que el contenido sea un array y no esté vacío
        $this->assertIsArray($data, 'El contenido del JSON no es un array válido.');
        $this->assertNotEmpty($data, 'El array de productos está vacío.');

        foreach ($data as $producto) {
            $this->assertArrayHasKey('id', $producto);
            $this->assertArrayHasKey('descripcion', $producto);
            $this->assertArrayHasKey('precio', $producto);
        }
    }
}
