<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_puede_registrarse_correctamente()
    {
        // Datos válidos para registro
        $data = [
            'name' => 'Juan',
            'surname' => 'Pérez',
            'dni' => '12345678',
            'cuil_cuit' => '20123456789',
            'address' => 'Calle Falsa 123',
            'floor' => '1',
            'department' => 'A',
            'locality' => 'Ciudad',
            'phone' => '123456789',
            'cellphone' => '987654321',
            'email' => 'juan@example.com',
            'username' => 'juanp',
            'password' => 'password123',
        ];

        // Enviar POST para registrar usuario
        $response = $this->post(route('procesarRegistro'), $data);

        // Debe redirigir a la ruta 'login'
        $response->assertRedirect(route('login'));

        // Verificar que el mensaje flash de éxito esté en la sesión
        $response->assertSessionHas('registro_de_usuario_exitoso', 'Usuario registrado exitosamente.');

        // Verificar que el usuario esté en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'juan@example.com',
            'usuario' => 'juanp',
            'name' => 'Juan',
            'apellido' => 'Pérez',
            'dni' => '12345678',
        ]);
    }
}
