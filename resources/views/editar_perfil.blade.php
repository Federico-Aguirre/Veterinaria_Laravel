@extends('layouts.app')

@section('content')
<section class="editarPerfil formulario">
    <div class="contenedor-formularios">
        
        {{-- Envoltorio semántico nav para accesibilidad y SEO --}}
        <nav aria-label="Navegación de gestión de perfil">
            <ul class="contenedor-tabs" style="margin:0" role="tablist">
                <li class="tab tab-primera active" role="presentation">
                    <a href="#editar-perfil" aria-current="page">Editar Perfil</a>
                </li>
                <li class="tab tab-segunda" role="presentation">
                    @livewire('ver-perfil')
                </li>
                <li class="tab tab-tercera" role="presentation">
                    @livewire('borrar-perfil')
                </li>
            </ul>
        </nav>

        <div class="contenido-tab">
            <div id="editar-perfil" style="display: block;" role="tabpanel" aria-label="Editar Perfil">
                @livewire('editar-perfil')
            </div>
        </div>
    </div>
</section>
@endsection