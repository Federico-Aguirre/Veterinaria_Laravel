@extends('layouts.app')

@section('content')
<section class="editarTurno formulario">
    <div class="contenedor-formularios">
        
        {{-- Envoltorio semántico nav para accesibilidad y SEO --}}
        <nav aria-label="Navegación de gestión de turnos">
            <ul class="contenedor-tabs" style="margin:0" role="tablist">
                <li class="tab tab-primera" role="presentation">
                    <a href="{{ route('agregar_turno_formulario') }}">Agregar Turno</a>
                </li>
                <li class="tab tab-segunda active" role="presentation">
                    <a href="{{ route('editar_turno') }}" aria-current="page">Editar Turno</a>
                </li>
                <li class="tab tab-tercera" role="presentation">
                    <a href="{{ route('ver_turno') }}">Ver Turno</a>
                </li>
                <li class="tab tab-cuarta" role="presentation">
                    <a href="{{ route('borrar_turno') }}">Borrar Turno</a>
                </li>
            </ul>
        </nav>

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