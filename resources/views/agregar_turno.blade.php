@extends('layouts.app')

@section('content')
<section class="agregarTurno formulario">
    <div class="contenedor-formularios">
        
        {{-- Contenedor semántico de navegación navegable por teclado y lectores de pantalla --}}
        <nav aria-label="Navegación de gestión de turnos">
            <ul class="contenedor-tabs" style="margin:0" role="tablist">
                <li class="tab tab-primera active" role="presentation">
                    <a href="{{ route('agregar_turno_formulario') }}" aria-current="page">Agregar Turno</a>
                </li>
                <li class="tab tab-segunda" role="presentation">
                    <a href="{{ route('editar_turno') }}">Editar Turno</a>
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
            @livewire('agregar-turno')
        </div>
    </div>
</section>
@endsection