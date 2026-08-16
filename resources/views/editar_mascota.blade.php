@extends('layouts.app')

@section('content')
<section class="editarMascota formulario">
    <div class="contenedor-formularios">
        
        {{-- Envoltorio semántico nav para accesibilidad y SEO --}}
        <nav aria-label="Navegación de gestión de mascotas">
            <ul class="contenedor-tabs" style="margin:0" role="tablist">
                <li class="tab tab-primera" role="presentation">
                    <a href="{{ route('agregar_mascota_formulario') }}">Agregar Mascota</a>
                </li>
                <li class="tab tab-segunda active" role="presentation">
                    <a href="{{ route('editar_mascota_formulario') }}" aria-current="page">Editar Mascota</a>
                </li>
                <li class="tab tab-tercera" role="presentation">
                    <a href="{{ route('ver_mascota') }}">Ver Mascota</a>
                </li>
                <li class="tab tab-cuarta" role="presentation">
                    <a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a>
                </li>
            </ul>
        </nav>

        <div class="contenido-tab">
            <br />
            {{-- Componente Livewire --}}
            @livewire('editar-mascota', ['mascotaId' => $mascotaId ?? null])
        </div>
    </div>
</section>
@endsection