<div x-data
     x-effect="if ($wire.alertMessage) { alert($wire.alertMessage) }">
    <form wire:submit.prevent="actualizarPerfil" aria-label="Formulario para editar perfil">
        <h1>Editar perfil</h1>

        <div class="contenedor-input">
            <label for="name">Nombre</label>
            <input type="text" id="name" wire:model.defer="name" required aria-required="true" autocomplete="given-name">
        </div>

        <div class="fila-arriba">
            <div class="contenedor-input">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" wire:model.defer="apellido" required aria-required="true" autocomplete="family-name">
            </div>
            <div class="contenedor-input">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" wire:model.defer="direccion" required aria-required="true" autocomplete="street-address">
            </div>
        </div>

        <div class="fila-arriba">
            <div class="contenedor-input">
                <label for="piso">Piso</label>
                <input type="number" id="piso" wire:model.defer="piso" required aria-required="true">
            </div>
            <div class="contenedor-input">
                <label for="departamento">Departamento</label>
                <input type="text" id="departamento" wire:model.defer="departamento" required aria-required="true">
            </div>
        </div>

        <div class="contenedor-input">
            <label for="localidad">Localidad</label>
            <input type="text" id="localidad" wire:model.defer="localidad" required aria-required="true" autocomplete="address-level2">
        </div>

        <div class="contenedor-input">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" wire:model.defer="telefono" required aria-required="true" autocomplete="tel">
        </div>

        <div class="contenedor-input">
            <label for="celular">Celular</label>
            <input type="text" id="celular" wire:model.defer="celular" required aria-required="true" autocomplete="tel">
        </div>

        <div class="contenedor-input">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model.defer="email" required aria-required="true" autocomplete="email">
        </div>

        {{-- Botón con prevención de doble clic e indicador de carga --}}
        <button type="submit" 
                class="button button-block"
                wire:loading.attr="disabled"
                wire:target="actualizarPerfil">
            <span wire:loading.remove wire:target="actualizarPerfil">Editar perfil</span>
            <span wire:loading wire:target="actualizarPerfil">Guardando...</span>
        </button>
    </form>
</div>