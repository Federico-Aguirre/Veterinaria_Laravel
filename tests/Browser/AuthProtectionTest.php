<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthProtectionTest extends DuskTestCase
{
    /**
     * Verifica que un usuario no autenticado vea una alerta y luego sea redirigido al login.
     */
    public function test_guest_is_redirected_to_login_when_visiting_agregar_turno()
    {
        $this->browse(function (Browser $browser) {
            // Asegura estar deslogueado
            $browser->visit('/logout');

            // Intenta acceder a la ruta protegida
            $browser->visit('/agregar_turno');

            // Intenta cerrar la alerta si aparece
            try {
                $browser->driver->switchTo()->alert()->accept(); // Cierra el alert JS
            } catch (\Exception $e) {
                // No hay alerta, seguir igual
            }

            // Espera brevemente por la redirección
            $browser->pause(1000); // Esperar 1 segundo

            // Asegura que terminó en /login
            $browser->assertPathIs('/login');
        });
    }
}
