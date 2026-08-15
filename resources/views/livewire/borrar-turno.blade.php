<div x-data="{ alerta: @entangle('alerta') }"
     x-init="$watch('alerta', value => { if(value){ alert(value); alerta = null } })">

    <div class="contenedor-input turnos__formulario__titulo">
        Borrar Turno
    </div>

    <div class="contenedor-input">
        <label for="turnoABorrar">Seleccionar Turno</label>
        <select id="turnoABorrar" wire:model="turnoSeleccionado">
            <option value="">Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
            @if($turnos->isEmpty())
                <option value="" disabled>No tienes turnos disponibles para borrar</option>
            @endif
        </select>
        @error('turnoSeleccionado') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="button" 
            class="button button-block" 
            wire:click="borrarTurno"
            wire:confirm="¿Estás seguro de que deseas borrar este turno?"
            @if($turnos->isEmpty()) disabled @endif>
        Borrar Turno
    </button>
</div>