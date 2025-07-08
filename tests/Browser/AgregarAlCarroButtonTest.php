<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AgregarAlCarroButtonTest extends DuskTestCase
{
    /** @test */
    public function boton_agregar_al_carro_visible_y_muestra_alerta_si_no_logueado()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ver_productos')
                    ->assertVisible('#btn-agregar-global')
                    ->click('#btn-agregar-global')
                    ->assertDialogOpened('Debes logearte para agregar un producto al carro.')
                    ->acceptDialog();
        });
    }
}
