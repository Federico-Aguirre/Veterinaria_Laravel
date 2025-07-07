<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos entre tests

    public function test_usuario_puede_registrarse_correctamente()
    {
        // Datos válidos para el formulario de registro
        $data = [
            'nombre' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Ejecutar la petición POST al registro
        $response = $this->post(route('procesarRegistro'), $data);

        // DEBUG opcional: mostrar respuesta en consola si algo falla
        // $response->dump();

        // Asegurarse que no hubo errores de validación
        $response->assertSessionHasNoErrors();

        // Asegurarse que redirige a la ruta login
        $response->assertRedirect(route('login'));

        // Asegurarse que el mensaje flash existe
        $response->assertSessionHas('registro_de_usuario_exitoso', 'Usuario registrado exitosamente.');

        // Verificar que el usuario fue creado en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'juan@example.com',
        ]);
    }
}
