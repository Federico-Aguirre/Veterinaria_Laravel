<div>
    <div x-data @alerta.window="alert($event.detail.mensaje)"></div>

    <div class="contenedor-input">
        <label for="turnoAEditar">Seleccionar Turno</label>
        <select 
            id="turnoAEditar" 
            wire:model="turnoSeleccionado" 
            class="turnos__formulario__select"
            @error('turnoSeleccionado') aria-invalid="true" aria-describedby="error-turno" @enderror
        >
            <option value="">Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
        </select>
        @error('turnoSeleccionado') <span class="error" id="error-turno" role="alert">{{ $message }}</span> @enderror
    </div>

    {{-- Se agregó el estado de carga para evitar doble clic --}}
    <button type="button" class="button button-block" wire:click="seleccionarTurno" wire:loading.attr="disabled" wire:target="seleccionarTurno">
        <span wire:loading.remove wire:target="seleccionarTurno">Seleccionar Turno</span>
        <span wire:loading wire:target="seleccionarTurno">Seleccionando...</span>
    </button>

    @if($confirmado)
        <form wire:submit.prevent="actualizar" class="turnos__formulario" aria-label="Formulario para editar turno" novalidate>
            
            {{-- Se agregó role="heading" para mejorar la estructura del documento en PageSpeed sin cambiar tu <div> --}}
            <div class="contenedor-input turnos__formulario__titulo" role="heading" aria-level="2">
                Editar Turno
            </div>

            {{-- Fecha con Flatpickr sincronizado dinámicamente --}}
            <div class="contenedor-input" x-data="{
                fp: null,
                init() {
                    this.fp = flatpickr(this.$refs.picker, {
                        enableTime: true,
                        dateFormat: 'Y-m-d H:i',
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
                    aria-required="true"
                    @error('fecha') aria-invalid="true" aria-describedby="error-fecha" @enderror
                >
                @error('fecha') <span class="error" id="error-fecha" role="alert">{{ $message }}</span> @enderror
            </div>

            <div class="contenedor-input">
                <label for="asunto">Asunto</label>
                <input 
                    type="text" 
                    id="asunto" 
                    wire:model="asunto" 
                    required 
                    aria-required="true"
                    @error('asunto') aria-invalid="true" aria-describedby="error-asunto" @enderror
                >
                @error('asunto') <span class="error" id="error-asunto" role="alert">{{ $message }}</span> @enderror
            </div>

            <div class="contenedor-input">
                <label for="mensaje">Mensaje</label>
                <textarea 
                    id="mensaje" 
                    wire:model="mensaje"
                    @error('mensaje') aria-invalid="true" aria-describedby="error-mensaje" @enderror
                ></textarea>
                @error('mensaje') <span class="error" id="error-mensaje" role="alert">{{ $message }}</span> @enderror
            </div>

            {{-- Se cambió el <input> por un <button> para poder mostrar el indicador de carga --}}
            <button type="submit" class="button button-block" wire:loading.attr="disabled" wire:target="actualizar">
                <span wire:loading.remove wire:target="actualizar">Actualizar Turno</span>
                <span wire:loading wire:target="actualizar">Actualizando...</span>
            </button>
        </form>
    @endif
</div>