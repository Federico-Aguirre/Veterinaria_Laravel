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

    <form wire:submit.prevent="verMascota">
        <div class="contenedor-input">
            <label>Selecciona una mascota para ver:</label>
            <select wire:model="mascota_id" required>
                <option value="">Selecciona una mascota</option>
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="button button-block">
            Ver Mascota
        </button>
    </form>
</div>