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

    <form wire:submit.prevent="guardarMascota" novalidate aria-label="Formulario para agregar mascota">
        @csrf

        {{-- Nombre --}}
        <div class="contenedor-input">
            <label for="nombre">Nombre de la mascota <span class="req" aria-hidden="true">*</span></label>
            <input 
                type="text" 
                id="nombre" 
                wire:model="nombre" 
                required 
                aria-required="true"
                @error('nombre') aria-invalid="true" aria-describedby="error-nombre" @enderror
            >
            @error('nombre') 
                <div class="error" id="error-nombre" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Raza --}}
        <div class="contenedor-input">
            <label for="raza">Raza <span class="req" aria-hidden="true">*</span></label>
            <input 
                type="text" 
                id="raza" 
                wire:model="raza" 
                required 
                aria-required="true"
                @error('raza') aria-invalid="true" aria-describedby="error-raza" @enderror
            >
            @error('raza') 
                <div class="error" id="error-raza" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Sexo --}}
        <div class="contenedor-input">
            <label for="sexo">Sexo <span class="req" aria-hidden="true">*</span></label>
            <input 
                type="text" 
                id="sexo" 
                wire:model="sexo" 
                required 
                aria-required="true"
                @error('sexo') aria-invalid="true" aria-describedby="error-sexo" @enderror
            >
            @error('sexo') 
                <div class="error" id="error-sexo" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Edad --}}
        <div class="contenedor-input">
            <label for="edad">Edad <span class="req" aria-hidden="true">*</span></label>
            <input 
                type="number" 
                id="edad" 
                wire:model="edad" 
                min="0" 
                step="1" 
                required 
                aria-required="true"
                @error('edad') aria-invalid="true" aria-describedby="error-edad" @enderror
            >
            @error('edad') 
                <div class="error" id="error-edad" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Microchip --}}
        <div class="contenedor-input">
            <label for="nro_de_microchip">Nro. de microchip</label>
            <input type="text" id="nro_de_microchip" wire:model="nro_de_microchip">
        </div>

        {{-- Vacuna antirrábica --}}
        <div class="contenedor-input flex items-center gap-2">
            <input type="checkbox" id="vacuna_antirrabica" wire:model="vacuna_antirrabica">
            <label for="vacuna_antirrabica">Vacuna antirrábica</label>
        </div>

        {{-- Tratamiento antiparasitario --}}
        <div class="contenedor-input flex items-center gap-2">
            <input type="checkbox" id="tratamiento_antiparasitario" wire:model="tratamiento_antiparasitario">
            <label for="tratamiento_antiparasitario">Tratamiento antiparasitario</label>
        </div>

        {{-- Otras vacunas --}}
        <div class="contenedor-input">
            <label for="otras_vacunas">Otras vacunas</label>
            <input type="text" id="otras_vacunas" wire:model="otras_vacunas">
        </div>

        {{-- Información adicional --}}
        <div class="contenedor-input">
            <label for="informacion_adicional">Información adicional</label>
            <input type="text" id="informacion_adicional" wire:model="informacion_adicional">
        </div>

        {{-- Botón de envío con estado de carga --}}
        <button 
            type="submit" 
            class="button button-block" 
            wire:loading.attr="disabled"
            wire:target="guardarMascota"
        >
            <span wire:loading.remove wire:target="guardarMascota">Agregar mascota</span>
            <span wire:loading wire:target="guardarMascota">Guardando...</span>
        </button>
    </form>
</div>