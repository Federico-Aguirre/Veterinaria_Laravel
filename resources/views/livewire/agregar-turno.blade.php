<div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                alert("{{ session('success') }}");
            });
        </script>
    @endif

    <form wire:submit.prevent="guardarTurno" class="turnos__formulario">
        <div class="contenedor-input turnos__formulario__titulo">Solicitar Turno</div>

        <div class="contenedor-input" x-data="{
            init() {
                flatpickr(this.$refs.fechaInput, {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    minDate: 'today',
                    minuteIncrement: 30,
                    onChange: (selectedDates, dateStr) => {
                        $wire.set('fecha', dateStr);
                    }
                });
            }
        }">
            <label for="fecha">Fecha</label>
            <input 
                id="fecha" 
                x-ref="fechaInput"
                type="text" 
                wire:model="fecha" 
                placeholder="Seleccione fecha y hora"
                readonly
                required
            >
            @error('fecha') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="contenedor-input">
            <label for="id_mascota">Mascota a atender</label>
            <select id="id_mascota" wire:model="id_mascota" required>
                <option value="">Selecciona una mascota</option>
                @if(!empty($mascotas))
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                    @endforeach
                @endif
            </select>
            @error('id_mascota') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="contenedor-input">
            <label for="asunto">Asunto</label>
            <input id="asunto" type="text" wire:model="asunto" required>
            @error('asunto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="contenedor-input">
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" wire:model="mensaje"></textarea>
            @error('mensaje') <div class="error">{{ $message }}</div> @enderror
        </div>

        <input type="submit" value="Enviar">
    </form>
</div>