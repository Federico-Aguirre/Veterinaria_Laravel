<div>
    <div x-data x-on:mascota-actualizada.window="alert($event.detail.message)"></div>

    @if(!$mascotaId)
        <!-- Selector -->
        <div class="contenedor-input">
            <label>Selecciona una mascota para editar:</label>
            <select x-ref="select">
                <option value="">Selecciona una mascota</option>
                @foreach ($mascotas as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button class="button button-block"
            x-data
            @click="if($refs.select.value){ window.location.href='/editar_mascota/' + $refs.select.value } else { alert('Selecciona una mascota') }">
            Seleccionar Mascota
        </button>
    @else
        <!-- Formulario edición -->
        <form wire:submit.prevent="actualizarMascota">
            @csrf
            <div class="contenedor-input">
                <label>Nombre <span class="req">*</span></label>
                <input type="text" wire:model="nombre">
                @error('nombre') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label>Raza <span class="req">*</span></label>
                <input type="text" wire:model="raza">
                @error('raza') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label>Sexo <span class="req">*</span></label>
                <input type="text" wire:model="sexo">
                @error('sexo') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label>Edad <span class="req">*</span></label>
                <input type="number" wire:model="edad">
                @error('edad') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label>Nro. microchip</label>
                <input type="text" wire:model="nro_de_microchip">
            </div>

            <div class="contenedor-input">
                <label>Vacuna antirrábica</label>
                <input type="checkbox" wire:model="vacuna_antirrabica">
            </div>

            <div class="contenedor-input">
                <label>Tratamiento antiparasitario</label>
                <input type="checkbox" wire:model="tratamiento_antiparasitario">
            </div>

            <div class="contenedor-input">
                <label>Otras vacunas</label>
                <input type="text" wire:model="otras_vacunas">
            </div>

            <div class="contenedor-input">
                <label>Información adicional</label>
                <input type="text" wire:model="informacion_adicional">
            </div>

            <input type="submit" class="button button-block" value="Actualizar mascota">
        </form>
    @endif
</div>