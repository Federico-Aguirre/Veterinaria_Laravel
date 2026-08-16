@extends('layouts.app')

@section('content')
    <section class="borrarMascota formulario">
        <div class="contenedor-formularios">
            
            {{-- Envoltorio semántico nav para accesibilidad y SEO --}}
            <nav aria-label="Navegación de gestión de mascotas">
                <ul class="contenedor-tabs" style="margin:0" role="tablist">
                    <li class="tab tab-primera" role="presentation">
                        <a href="{{ route('agregar_mascota_formulario') }}">Agregar Mascota</a>
                    </li>
                    <li class="tab tab-segunda" role="presentation">
                        <a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a>
                    </li>
                    <li class="tab tab-tercera" role="presentation">
                        <a href="{{ route('ver_mascota') }}">Ver Mascota</a>
                    </li>
                    <li class="tab tab-cuarta active" role="presentation">
                        <a href="{{ route('borrar_mascota_formulario') }}" aria-current="page">Borrar Mascota</a>
                    </li>
                </ul>
            </nav>

            <div class="contenido-tab">
                <br />
                @livewire('borrar-mascota')
            </div>
        </div>
    </section>
@endsection