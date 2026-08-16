<div>
    <div x-data x-on:mascota-actualizada.window="alert($event.detail.message)"></div>

    @if(!$mascotaId)
        <!-- Selector -->
        <div class="contenedor-input">
            {{-- Se agregó for e id para vincular el label con el select --}}
            <label for="mascota_select">Selecciona una mascota para editar:</label>
            <select id="mascota_select" x-ref="select">
                <option value="">Selecciona una mascota</option>
                @foreach ($mascotas as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        {{-- Se agregó type="button" para evitar comportamientos inesperados en algunos navegadores --}}
        <button type="button" 
            class="button button-block"
            x-data
            @click="if($refs.select.value){ window.location.href='/editar_mascota/' + $refs.select.value } else { alert('Selecciona una mascota') }">
            Seleccionar Mascota
        </button>
    @else
        <!-- Formulario edición -->
        <form wire:submit.prevent="actualizarMascota" aria-label="Formulario para editar mascota" novalidate>
            @csrf
            
            <div class="contenedor-input">
                <label for="nombre">Nombre <span class="req" aria-hidden="true">*</span></label>
                <input type="text" id="nombre" wire:model="nombre" required aria-required="true"
                       @error('nombre') aria-invalid="true" aria-describedby="error-nombre" @enderror>
                @error('nombre') <div class="error" id="error-nombre" role="alert">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label for="raza">Raza <span class="req" aria-hidden="true">*</span></label>
                <input type="text" id="raza" wire:model="raza" required aria-required="true"
                       @error('raza') aria-invalid="true" aria-describedby="error-raza" @enderror>
                @error('raza') <div class="error" id="error-raza" role="alert">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label for="sexo">Sexo <span class="req" aria-hidden="true">*</span></label>
                <input type="text" id="sexo" wire:model="sexo" required aria-required="true"
                       @error('sexo') aria-invalid="true" aria-describedby="error-sexo" @enderror>
                @error('sexo') <div class="error" id="error-sexo" role="alert">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label for="edad">Edad <span class="req" aria-hidden="true">*</span></label>
                <input type="number" id="edad" wire:model="edad" required aria-required="true"
                       @error('edad') aria-invalid="true" aria-describedby="error-edad" @enderror>
                @error('edad') <div class="error" id="error-edad" role="alert">{{ $message }}</div> @enderror
            </div>

            <div class="contenedor-input">
                <label for="nro_de_microchip">Nro. microchip</label>
                <input type="text" id="nro_de_microchip" wire:model="nro_de_microchip">
            </div>

            <div class="contenedor-input">
                <label for="vacuna_antirrabica">Vacuna antirrábica</label>
                <input type="checkbox" id="vacuna_antirrabica" wire:model="vacuna_antirrabica">
            </div>

            <div class="contenedor-input">
                <label for="tratamiento_antiparasitario">Tratamiento antiparasitario</label>
                <input type="checkbox" id="tratamiento_antiparasitario" wire:model="tratamiento_antiparasitario">
            </div>

            <div class="contenedor-input">
                <label for="otras_vacunas">Otras vacunas</label>
                <input type="text" id="otras_vacunas" wire:model="otras_vacunas">
            </div>

            <div class="contenedor-input">
                <label for="informacion_adicional">Información adicional</label>
                <input type="text" id="informacion_adicional" wire:model="informacion_adicional">
            </div>

            {{-- Se cambió <input type="submit"> por <button> para poder incorporar los estados de carga de Livewire --}}
            <button type="submit" 
                    class="button button-block"
                    wire:loading.attr="disabled"
                    wire:target="actualizarMascota">
                <span wire:loading.remove wire:target="actualizarMascota">Actualizar mascota</span>
                <span wire:loading wire:target="actualizarMascota">Actualizando...</span>
            </button>
        </form>
    @endif
</div>