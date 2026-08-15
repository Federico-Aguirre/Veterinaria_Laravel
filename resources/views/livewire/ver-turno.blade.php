<div x-data="{ alerta: @entangle('alerta') }" x-init="$watch('alerta', value => { if(value) { alert(value); alerta = null } })">
    <div class="contenedor-input turnos__formulario__titulo">
        Consultar Turno
    </div>

    <div class="contenedor-input">
        <label for="turnoAver">Seleccionar Turno</label>
        <select id="turnoAver" wire:model="turnoSeleccionado" class="turnos__formulario__select">
            <option value="">Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
            @if($turnos->isEmpty())
                <option value="" disabled>No tienes turnos registrados</option>
            @endif
        </select>
        @error('turnoSeleccionado') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="button" class="button button-block" wire:click="mostrarTurno" @if($turnos->isEmpty()) disabled @endif>
        Ver Turno
    </button>

    {{-- Vista detallada del turno seleccionado --}}
    @if(isset($confirmado) && $confirmado)
        <div class="turnos__formulario mt-6">
            <div class="contenedor-input turnos__formulario__titulo">
                Detalles del Turno
            </div>

            <div class="contenedor-input">
                <label>Fecha y Hora</label>
                <input type="text" value="{{ $fecha }}" readonly disabled />
            </div>

            @if(isset($mascota))
                <div class="contenedor-input">
                    <label>Mascota</label>
                    <input type="text" value="{{ $mascota->nombre ?? $mascota }}" readonly disabled />
                </div>
            @endif

            <div class="contenedor-input">
                <label>Asunto</label>
                <input type="text" value="{{ $asunto }}" readonly disabled />
            </div>

            <div class="contenedor-input">
                <label>Mensaje / Observaciones</label>
                <textarea readonly disabled>{{ $mensaje }}</textarea>
            </div>
        </div>
    @endif
</div>