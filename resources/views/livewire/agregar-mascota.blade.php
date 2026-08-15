<div>
    {{-- Alerta JS cuando viene redirigido desde Turnos --}}
    @if(session('alert'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                alert("{{ session('alert') }}");
            });
        </script>
    @endif

    <!-- Escucha eventos Livewire en la ventana -->
    <div x-data x-on:mascota-creada.window="alert($event.detail.message)"></div>

    <form wire:submit.prevent="guardarMascota">
        @csrf

        <div class="contenedor-input">
            <label>Nombre de la mascota <span class="req">*</span></label>
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
            <label>Nro. de microchip</label>
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

        <input type="submit" class="button button-block" value="Agregar mascota">
    </form>
</div>