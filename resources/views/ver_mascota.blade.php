@extends('layouts.app')

@section('content')
    <section class="verMascota formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_mascota_formulario') }}">Agregar Mascota</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a></li>
                <li class="tab tab-tercera active"><a href="{{ route('ver_mascota') }}">Ver Mascota</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a></li>
            </ul>

            <div class="contenido-tab">
                <br />
                @livewire('ver-mascota')
            </div>
        </div>
    </section>
@endsection