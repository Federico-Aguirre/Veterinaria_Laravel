<div>
    <!-- Escucha eventos Livewire desde Alpine -->
    <div x-data 
         x-on:mascota-borrada.window="alert($event.detail.message)" 
         x-on:mascota-error.window="alert($event.detail.message)">
    </div>

    <form wire:submit.prevent="borrarMascota">
        <div class="contenedor-input">
            <label>Selecciona una mascota para borrar:</label>
            <select wire:model="mascota_id" required>
                <option value="">Selecciona una mascota</option>
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}">
                        {{ $mascota->nombre }}
                    </option>
                @endforeach
            </select>
            @error('mascota_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="button button-block">
            Borrar Mascota
        </button>
    </form>
</div>