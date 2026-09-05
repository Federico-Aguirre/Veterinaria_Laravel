<div x-data="{ alerta: @entangle('alerta') }" x-init="$watch('alerta', value => { if(value) { alert(value); alerta = null } })">
    <div class="contenedor-input turnos__formulario__titulo" role="heading" aria-level="2">
        Consultar Turno
    </div>

    <div class="contenedor-input">
        <label for="turnoAver">Seleccionar Turno</label>
        <select 
            id="turnoAver" 
            wire:model="turnoSeleccionado" 
            class="turnos__formulario__select"
            @error('turnoSeleccionado') aria-invalid="true" aria-describedby="error-turno-ver" @enderror
        >
            <option value="">Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
            @if($turnos->isEmpty())
                <option value="" disabled>No tienes turnos registrados</option>
            @endif
        </select>
        @error('turnoSeleccionado') <span class="error" id="error-turno-ver" role="alert">{{ $message }}</span> @enderror
    </div>

    <button 
        type="button" 
        class="button button-block" 
        wire:click="mostrarTurno" 
        wire:loading.attr="disabled"
        wire:target="mostrarTurno"
        @if($turnos->isEmpty()) disabled @endif
    >
        <span wire:loading.remove wire:target="mostrarTurno">Ver Turno</span>
        <span wire:loading wire:target="mostrarTurno">Cargando...</span>
    </button>

    {{-- Vista detallada del turno seleccionado --}}
    @if(isset($confirmado) && $confirmado)
        <div class="turnos__formulario mt-6" role="region" aria-label="Detalles del turno seleccionado">
            <div class="contenedor-input turnos__formulario__titulo" role="heading" aria-level="3">
                Detalles del Turno
            </div>

            <div class="contenedor-input">
                <label for="detalle_fecha">Fecha y Hora</label>
                <input type="text" id="detalle_fecha" value="{{ $fecha }}" readonly disabled />
            </div>

            @if(isset($mascota))
                <div class="contenedor-input">
                    <label for="detalle_mascota">Mascota</label>
                    <input type="text" id="detalle_mascota" value="{{ $mascota->nombre ?? $mascota }}" readonly disabled />
                </div>
            @endif

            <div class="contenedor-input">
                <label for="detalle_asunto">Asunto</label>
                <input type="text" id="detalle_asunto" value="{{ $asunto }}" readonly disabled />
            </div>

            <div class="contenedor-input">
                <label for="detalle_mensaje">Mensaje / Observaciones</label>
                <textarea id="detalle_mensaje" readonly disabled>{{ $mensaje }}</textarea>
            </div>
        </div>
    @endif
</div>