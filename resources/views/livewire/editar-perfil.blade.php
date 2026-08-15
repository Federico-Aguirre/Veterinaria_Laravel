<div x-data
     x-effect="if ($wire.alertMessage) { alert($wire.alertMessage) }">
    <form wire:submit.prevent="actualizarPerfil">
        <h1>Editar perfil</h1>

        <div class="contenedor-input">
            <label>Nombre</label>
            <input type="text" wire:model.defer="name" required>
        </div>

        <div class="fila-arriba">
            <div class="contenedor-input">
                <label>Apellido</label>
                <input type="text" wire:model.defer="apellido" required>
            </div>
            <div class="contenedor-input">
                <label>Dirección</label>
                <input type="text" wire:model.defer="direccion" required>
            </div>
        </div>

        <div class="fila-arriba">
            <div class="contenedor-input">
                <label>Piso</label>
                <input type="number" wire:model.defer="piso" required>
            </div>
            <div class="contenedor-input">
                <label>Departamento</label>
                <input type="text" wire:model.defer="departamento" required>
            </div>
        </div>

        <div class="contenedor-input">
            <label>Localidad</label>
            <input type="text" wire:model.defer="localidad" required>
        </div>

        <div class="contenedor-input">
            <label>Teléfono</label>
            <input type="text" wire:model.defer="telefono" required>
        </div>

        <div class="contenedor-input">
            <label>Celular</label>
            <input type="text" wire:model.defer="celular" required>
        </div>

        <div class="contenedor-input">
            <label>Email</label>
            <input type="email" wire:model.defer="email" required>
        </div>

        <button type="submit" class="button button-block">Editar perfil</button>
    </form>
</div>
