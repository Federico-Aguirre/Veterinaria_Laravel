<div>
    {{-- Alerta para mensajes flasheados en sesión --}}
    @if(session('success'))
        <div x-data x-init="alert('{{ session('success') }}')"></div>
    @endif

    @if(session('alert'))
        <div x-data x-init="alert('{{ session('alert') }}')"></div>
    @endif

    {{-- Listener para eventos dispatch enviadas desde Livewire --}}
    <div x-data 
         @alerta.window="alert($event.detail.mensaje)" 
         @turno-creado.window="alert($event.detail.message)">
    </div>

    <form wire:submit.prevent="guardarTurno" class="turnos__formulario" novalidate aria-label="Formulario para solicitar turno">
        
        {{-- Título convertido a etiqueta semántica h2 --}}
        <h2 class="contenedor-input turnos__formulario__titulo">Solicitar Turno</h2>

        {{-- Campo de Fecha con Flatpickr --}}
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
            <label for="fecha">Fecha y hora <span class="req" aria-hidden="true">*</span></label>
            <input 
                id="fecha" 
                x-ref="fechaInput"
                type="text" 
                wire:model="fecha" 
                placeholder="Seleccione fecha y hora"
                readonly
                required
                aria-required="true"
                @error('fecha') aria-invalid="true" aria-describedby="error-fecha" @enderror
            >
            @error('fecha') 
                <div class="error" id="error-fecha" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Selección de Mascota --}}
        <div class="contenedor-input">
            <label for="id_mascota">Mascota a atender <span class="req" aria-hidden="true">*</span></label>
            <select 
                id="id_mascota" 
                wire:model="id_mascota" 
                required 
                aria-required="true"
                @error('id_mascota') aria-invalid="true" aria-describedby="error-mascota" @enderror
            >
                <option value="">Selecciona una mascota</option>
                @if(!empty($mascotas))
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                    @endforeach
                @endif
            </select>
            @error('id_mascota') 
                <div class="error" id="error-mascota" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Asunto --}}
        <div class="contenedor-input">
            <label for="asunto">Asunto <span class="req" aria-hidden="true">*</span></label>
            <input 
                id="asunto" 
                type="text" 
                wire:model="asunto" 
                required 
                aria-required="true"
                @error('asunto') aria-invalid="true" aria-describedby="error-asunto" @enderror
            >
            @error('asunto') 
                <div class="error" id="error-asunto" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Mensaje --}}
        <div class="contenedor-input">
            <label for="mensaje">Mensaje u observaciones</label>
            <textarea 
                id="mensaje" 
                wire:model="mensaje"
                @error('mensaje') aria-invalid="true" aria-describedby="error-mensaje" @enderror
            ></textarea>
            @error('mensaje') 
                <div class="error" id="error-mensaje" role="alert">{{ $message }}</div> 
            @enderror
        </div>

        {{-- Botón de envío optimizado con indicador de carga --}}
        <button 
            type="submit" 
            class="button button-block"
            wire:loading.attr="disabled"
            wire:target="guardarTurno"
        >
            <span wire:loading.remove wire:target="guardarTurno">Enviar</span>
            <span wire:loading wire:target="guardarTurno">Solicitando turno...</span>
        </button>
    </form>
</div>