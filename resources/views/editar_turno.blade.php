@extends('layouts.app')

@section('content')
    <section class="editarTurno formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_turno_formulario') }}">Agregar Turno</a></li>
                <li class="tab tab-segunda active"><a href="{{ route('editar_turno') }}">Editar Turno</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_turno') }}">Ver Turno</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_turno') }}">Borrar Turno</a></li>
            </ul>

            <div class="contenido-tab">
                <br />
                @auth
                    @livewire('editar-turno')
                @else
                    <script>
                        alert("Debes iniciar sesión para editar turnos");
                        window.location = "{{ route('login') }}";
                    </script>
                @endauth
            </div>
        </div>
    </section>
@endsection