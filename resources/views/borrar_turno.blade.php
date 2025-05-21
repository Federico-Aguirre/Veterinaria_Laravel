@extends('layouts.app')

@if(session('turno_eliminado'))
    <script>
        alert("{{ session('turno_eliminado') }}");
    </script>
@endif

@section('content')
    <section class="borrarTurno formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_turno') }}">Agregar Turno</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_turno') }}">Editar Turno</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_turno') }}">Ver Turno</a></li>
                <li class="tab tab-cuarta active"><a href="{{ route('borrar_turno') }}">Borrar Turno</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="borrar-turno">
                    <br />
                    @if(Auth::check())
                    <form id="formBorrarTurno" method="post">
                        @csrf
                        @method('POST')
                        <div class="contenedor-input turnos__formulario__titulo">
                            Borrar Turno
                        </div>

                        <div class="contenedor-input">
                            <label for="turnoABorrar">Seleccionar Turno</label>
                            <select id="turnoABorrar" name="id" class="turnos__formulario__turnoABorrar" required>
                                @if($turnos->isEmpty())
                                    <option value="">No tienes turnos disponibles para borrar</option>
                                @else
                                    @foreach($turnos as $turno)
                                        <option value="{{ $turno->id }}">{{ $turno->Fecha }} - {{ $turno->Asunto }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <input type="submit" value="Borrar Turno">
                    </form>

                    <script>
                        document.getElementById('formBorrarTurno').addEventListener('submit', function(event) {
                            event.preventDefault();
                            let turnoId = document.getElementById('turnoABorrar').value;

                            if (!turnoId) {
                                alert('Por favor, selecciona un turno para borrar.');
                                return;
                            }

                            let actionUrl = "{{ route('borrar_turno_destroy', ':id') }}".replace(':id', turnoId);
                            this.action = actionUrl;
                            this.submit();
                        });
                    </script>
                    @else
                        <script type="text/javascript">
                            alert("Debes iniciar sesión para borrar turnos");
                            window.location = "{{ route('login') }}";
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection