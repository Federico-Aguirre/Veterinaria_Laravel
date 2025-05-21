@extends('layouts.app')

@if(session('turno_creado_exitosamente'))
    <script>
        alert("{{ session('turno_creado_exitosamente') }}");
    </script>
@endif

@section('content')
    <section class="agregarTurno formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera active"><a href="{{ route('agregar_turno') }}">Agregar Turno</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_turno') }}">Editar Turno</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_turno') }}">Ver Turno</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_turno') }}">Borrar Turno</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="agregar-turno">
                    <br />
                    @if(Auth::check())  <!-- Verifica si el usuario está autenticado -->
                        <form action="{{ route('agregar_turno') }}" method="post" class="turnos__formulario">
                            @csrf  <!-- Token de seguridad para el formulario -->
                            <div class="contenedor-input turnos__formulario__titulo">
                                Solicitar Turno
                            </div>
                            <div class="contenedor-input">
                                <div class="contenedor-input">
                                    <label for="fecha">Fecha</label>
                                </div>
                                <input id="fecha" name="Fecha" type="datetime-local" class="turnos__formulario__fecha" step="1800" onkeydown="return false" required>
                            </div>
                            <div class="contenedor-input">
                                <div class="contenedor-input">
                                    <label for="mascotaAAtender">Mascota a atender</label>
                                </div>
                                <select id="mascotaAAtender" name="Id_mascota" class="turnos__formulario__mascotaAAtender" required>
                                @if($mascotas && $mascotas->isNotEmpty())
                                    @foreach($mascotas as $mascota)
                                        <option value="{{ $mascota->id }}">{{ $mascota->Nombre }}</option>
                                    @endforeach
                                @else
                                    <option value="">No tienes mascotas asociadas</option>
                                @endif
                                </select>
                            </div>

                            <div class="contenedor-input">
                                <label for="asuntoAAtender">Asunto</label>
                                <input id="asuntoAAtender" name="Asunto" type="text" required>
                            </div>

                            <div class="contenedor-input">
                                <label for="textarea">Mensaje</label>
                                <textarea id="textarea" name="Mensaje"></textarea>
                            </div>
                            
                            <input type="submit" value="Enviar">
                        </form>
                    @else
                        <script type="text/javascript">
                            alert("Debes iniciar sesión para solicitar turnos");
                            window.location = "{{ route('login') }}"; 
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection