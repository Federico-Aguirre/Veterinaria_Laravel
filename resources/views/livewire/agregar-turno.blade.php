<div>
    <div x-data @alerta.window="alert($event.detail.mensaje)"></div>

    <div class="contenedor-input">
        <label for="turnoAEditar">Seleccionar Turno</label>
        <select id="turnoAEditar" wire:model="turnoSeleccionado" class="turnos__formulario__select">
            <option value="">Elegí un turno</option>
            @forelse($turnos ?? [] as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
        </select>
        @error('turnoSeleccionado') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="button" class="button button-block" wire:click="seleccionarTurno">
        Seleccionar Turno
    </button>

    @if($confirmado)
        <form wire:submit.prevent="actualizar" class="turnos__formulario">
            <div class="contenedor-input turnos__formulario__titulo">
                Editar Turno
            </div>

            <div class="contenedor-input" x-data="{
                fp: null,
                init() {
                    this.fp = flatpickr(this.$refs.picker, {
                        enableTime: true,
                        dateFormat: 'Y-m-d\\TH:i', {{-- Cambiado para coincidir con la validación de Laravel --}}
                        defaultDate: $wire.fecha || null,
                        minDate: 'today',
                        minuteIncrement: 30,
                        onChange: (selectedDates, dateStr) => {
                            $wire.set('fecha', dateStr);
                        }
                    });

                    this.$watch('$wire.fecha', newDate => {
                        if (newDate && this.fp) {
                            this.fp.setDate(newDate, false);
                        }
                    });
                }
            }">
                <label for="fecha">Fecha</label>
                <input 
                    x-ref="picker" 
                    id="fecha" 
                    type="text" 
                    placeholder="Seleccione fecha y hora"
                    readonly 
                    required
                >
                @error('fecha') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="contenedor-input">
                <label for="asunto">Asunto</label>
                <input type="text" id="asunto" wire:model="asunto" required>
                @error('asunto') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="contenedor-input">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" wire:model="mensaje"></textarea>
                @error('mensaje') <span class="error">{{ $message }}</span> @enderror
            </div>

            <input type="submit" value="Actualizar Turno">
        </form>
    @endif
</div>