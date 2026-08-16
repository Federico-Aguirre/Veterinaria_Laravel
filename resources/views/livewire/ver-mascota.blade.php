<div>
    <!-- Alpine escucha eventos y muestra el alert -->
    <div x-data 
         x-on:mostrar-mascota.window="
            let m = $event.detail.mascota;
            alert(
                `🐾 Mascota Seleccionada 🐾\n\n` +
                `Nombre: ${m.nombre}\n` +
                `Raza: ${m.raza}\n` +
                `Sexo: ${m.sexo}\n` +
                `Edad: ${m.edad} años\n` +
                `Nro. de Microchip: ${m.microchip || 'No registrado'}\n` +
                `Vacuna Antirrábica: ${m.vacuna}\n` +
                `Tratamiento Antiparasitario: ${m.antiparasitario}\n` +
                `Otras Vacunas: ${m.otras_vacunas || 'No especificado'}\n` +
                `Información Adicional: ${m.informacion_adicional || 'No disponible'}`
            )
         "
         x-on:mascota-error.window="alert($event.detail.message)">
    </div>

    {{-- Se agregó un aria-label para describir el propósito del formulario a lectores de pantalla --}}
    <form wire:submit.prevent="verMascota" aria-label="Formulario para consultar información de mascota">
        <div class="contenedor-input">
            {{-- Se agregó el atributo 'for' que debe coincidir con el 'id' del select --}}
            <label for="mascota_id">Selecciona una mascota para ver:</label>
            <select 
                id="mascota_id" 
                wire:model="mascota_id" 
                required 
                aria-required="true"
            >
                <option value="">Selecciona una mascota</option>
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Estado de carga para evitar peticiones múltiples mientras el servidor responde --}}
        <button 
            type="submit" 
            class="button button-block"
            wire:loading.attr="disabled"
            wire:target="verMascota"
        >
            <span wire:loading.remove wire:target="verMascota">Ver Mascota</span>
            <span wire:loading wire:target="verMascota">Cargando información...</span>
        </button>
    </form>
</div>