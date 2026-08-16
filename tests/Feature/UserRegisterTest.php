<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos entre tests

    public function test_usuario_puede_registrarse_correctamente()
    {
$data = [
    'name' => 'Juan',
    'surname' => 'Pérez',
    'dni' => '12345678',
    'address' => 'Calle Falsa 123', 
    'locality' => 'Ciudad',
    'department' => 'a',
    'cellphone' => '1234567890',
    'username' => 'juanp',
    'email' => 'juan@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'floor' => '1', 
];


        $response = $this->post(route('procesarRegistro'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'email' => 'juan@example.com',
            'usuario' => 'juanp',
        ]);
    }

}
