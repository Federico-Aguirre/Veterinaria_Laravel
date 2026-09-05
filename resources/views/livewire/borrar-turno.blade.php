<div x-data="{ alerta: @entangle('alerta') }"
     x-init="$watch('alerta', value => { if(value){ alert(value); alerta = null } })">

    {{-- Se agrega role="heading" para que los lectores de pantalla lo reconozcan como título sin cambiar la etiqueta <div> --}}
    <div class="contenedor-input turnos__formulario__titulo" role="heading" aria-level="2">
        Borrar Turno
    </div>

    <div class="contenedor-input">
        <label for="turnoABorrar">Seleccionar Turno</label>
        <select 
            id="turnoABorrar" 
            wire:model="turnoSeleccionado"
            @error('turnoSeleccionado') aria-invalid="true" aria-describedby="error-turno" @enderror
        >
            <option value="">Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->fecha }} - {{ $turno->asunto }}</option>
            @endforeach
            @if($turnos->isEmpty())
                <option value="" disabled>No tienes turnos disponibles para borrar</option>
            @endif
        </select>
        
        {{-- Enlace accesible del error --}}
        @error('turnoSeleccionado') 
            <span class="error" id="error-turno" role="alert">{{ $message }}</span> 
        @enderror
    </div>

    <button type="button" 
            class="button button-block" 
            wire:click="borrarTurno"
            wire:confirm="¿Estás seguro de que deseas borrar este turno?"
            wire:loading.attr="disabled"
            wire:target="borrarTurno"
            @if($turnos->isEmpty()) disabled @endif>
        
        {{-- Indicadores visuales de estado de carga sin romper la lógica actual --}}
        <span wire:loading.remove wire:target="borrarTurno">Borrar Turno</span>
        <span wire:loading wire:target="borrarTurno">Borrando...</span>
    </button>
</div>