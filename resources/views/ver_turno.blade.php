@extends('layouts.app')

@section('content')
<section class="verTurno formulario">
    <div class="contenedor-formularios">
        
        {{-- Envoltorio semántico nav para accesibilidad y SEO --}}
        <nav aria-label="Navegación de gestión de turnos">
            <ul class="contenedor-tabs" style="margin:0" role="tablist">
                <li class="tab tab-primera" role="presentation">
                    <a href="{{ route('agregar_turno_formulario') }}">Agregar Turno</a>
                </li>
                <li class="tab tab-segunda" role="presentation">
                    <a href="{{ route('editar_turno') }}">Editar Turno</a>
                </li>
                <li class="tab tab-tercera active" role="presentation">
                    <a href="{{ route('ver_turno') }}" aria-current="page">Ver Turno</a>
                </li>
                <li class="tab tab-cuarta" role="presentation">
                    <a href="{{ route('borrar_turno') }}">Borrar Turno</a>
                </li>
            </ul>
        </nav>

        <div class="contenido-tab">
            <br />
            @auth
                @livewire('ver-turno')
            @else
                <script>
                    alert("Debes iniciar sesión para ver turnos");
                    window.location = "{{ route('login') }}";
                </script>
            @endauth
        </div>
    </div>
</section>
@endsection