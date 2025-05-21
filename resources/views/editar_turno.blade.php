@extends('layouts.app')

@if(session('Turno_actualizado'))
    <script>
        alert("{{ session('Turno_actualizado') }}");
    </script>
@endif

@section('content')
    <section class="editarTurno formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_turno') }}">Agregar Turno</a></li>
                <li class="tab tab-segunda active"><a href="{{ route('editar_turno') }}">Editar Turno</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_turno') }}">Ver Turno</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_turno') }}">Borrar Turno</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="editar-turno">
                    <br />
                    @if(Auth::check())
                        @if(!isset($turnoSeleccionado))
                            <!-- Formulario para seleccionar el turno -->
<form action="{{ route('editar_turno') }}" method="get" class="turnos__formulario">
    <div class="contenedor-input">
        <label for="turnoAEditar">Seleccionar Turno</label>
        <select id="turnoAEditar" name="id" required>
            <option value="" disabled selected>Elegí un turno</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->Fecha }} - {{ $turno->Asunto }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Seleccionar Turno">
</form>


                        @else
                            <!-- Formulario para editar el turno seleccionado -->
                            <form action="{{ route('editar_turno_update', ['id' => $turnoSeleccionado->id]) }}" method="post" class="turnos__formulario">
                                @csrf  <!-- Token de seguridad para el formulario -->
                                <div class="contenedor-input turnos__formulario__titulo">
                                    Editar Turno
                                </div>

                                <!-- Campo de fecha -->
                                <div class="contenedor-input">
                                    <label for="Fecha">Fecha</label>
                                    <input id="Fecha" name="Fecha" type="datetime-local" value="{{ old('Fecha', $turnoSeleccionado->Fecha ?? '') }}" required>
                                </div>

                                <!-- Campo de asunto -->
                                <div class="contenedor-input">
                                    <label for="asuntoAAtender">Asunto</label>
                                    <input id="asuntoAAtender" name="Asunto_a_atender" type="text" value="{{ old('Asunto_a_atender', $turnoSeleccionado->Asunto ?? '') }}" required>
                                </div>

                                <!-- Campo de mensaje -->
                                <div class="contenedor-input">
                                    <label for="textarea">Mensaje</label>
                                    <textarea id="textarea" name="Mensaje">{{ old('Mensaje', $turnoSeleccionado->Mensaje ?? '') }}</textarea>
                                </div>
                                
                                <input type="submit" value="Actualizar Turno">
                            </form>
                        @endif

                    @else
                        <script type="text/javascript">
                            alert("Debes iniciar sesión para editar turnos");
                            window.location = "{{ route('login') }}";  
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
