<div>
    <!-- Escucha eventos Livewire desde Alpine -->
    <div x-data 
         x-on:mascota-borrada.window="alert($event.detail.message)" 
         x-on:mascota-error.window="alert($event.detail.message)">
    </div>

    <form wire:submit.prevent="borrarMascota" aria-label="Formulario para eliminar una mascota" novalidate>
        <div class="contenedor-input">
            {{-- Etiqueta vinculada al select mediante for/id --}}
            <label for="mascota_id">
                Selecciona una mascota para borrar: <span class="req" aria-hidden="true">*</span>
            </label>
            
            <select 
                id="mascota_id" 
                wire:model="mascota_id" 
                required 
                aria-required="true"
                @error('mascota_id') aria-invalid="true" aria-describedby="error-mascota-id" @enderror
            >
                <option value="">Selecciona una mascota</option>
                @if(!empty($mascotas))
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id }}">
                            {{ $mascota->nombre }}
                        </option>
                    @endforeach
                @endif
            </select>
            
            {{-- Manejo de errores accesible --}}
            @error('mascota_id') 
                <div class="error" id="error-mascota-id" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Botón con prevención de doble clic e indicador de carga --}}
        <button 
            type="submit" 
            class="button button-block"
            wire:loading.attr="disabled"
            wire:target="borrarMascota"
        >
            <span wire:loading.remove wire:target="borrarMascota">Borrar Mascota</span>
            <span wire:loading wire:target="borrarMascota">Eliminando...</span>
        </button>
    </form>
</div>