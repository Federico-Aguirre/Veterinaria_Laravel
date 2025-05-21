@extends('layouts.app')

@section('content')
    <section class="verTurno formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_turno') }}">Agregar Turno</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_turno') }}">Editar Turno</a></li>
                <li class="tab tab-tercera active"><a href="{{ route('ver_turno') }}">Ver Turno</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_turno') }}">Borrar Turno</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="ver-turno">
                    <br />
                    @if(Auth::check())
                        <form id="formVerTurno" class="turnos__formulario">
                            <div class="contenedor-input">
                                <label for="turnoAver">Seleccionar Turno</label>
                                <select id="turnoAver" name="id" class="turnos__formulario__turnoAver" required>
                                    @if($turnos->isEmpty())
                                        <option value="">No tienes turnos disponibles</option>
                                    @else
                                        @foreach($turnos as $turno)
                                            <option value="{{ $turno->id }}" 
                                                data-fecha="{{ $turno->Fecha }}" 
                                                data-asunto="{{ $turno->Asunto }}" 
                                                data-mensaje="{{ $turno->Mensaje }}">
                                                {{ $turno->Fecha }} - {{ $turno->Asunto }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <input type="submit" value="Ver Turno" onclick="mostrarTurno()">
                        </form>
     
                        <script>
                            function mostrarTurno() {
                                let select = document.getElementById('turnoAver');
                                let turnoSeleccionado = select.options[select.selectedIndex];

                                if (turnoSeleccionado.value) {
                                    let fecha = turnoSeleccionado.getAttribute('data-fecha');
                                    let asunto = turnoSeleccionado.getAttribute('data-asunto');
                                    let mensaje = turnoSeleccionado.getAttribute('data-mensaje');

                                    alert(`Fecha: ${fecha}\nAsunto: ${asunto}\nMensaje: ${mensaje}`);
                                } else {
                                    alert('Por favor, selecciona un turno.');
                                }
                            }
                        </script>
                    @else
                        <script>
                            alert("Debes iniciar sesión para ver turnos");
                            window.location = "{{ route('login') }}";
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection