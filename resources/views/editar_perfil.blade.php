@extends('layouts.app')

@section('content')
<section class="editarPerfil formulario">
    <div class="contenedor-formularios">
        <ul class="contenedor-tabs" style="margin:0">
            <li class="tab tab-primera active"><a href="#editar-perfil">Editar Perfil</a></li>
            <li class="tab tab-segunda">@livewire('ver-perfil')</li>
            <li class="tab tab-tercera">@livewire('borrar-perfil')</li>
        </ul>

        <div class="contenido-tab">
            <div id="editar-perfil" style="display: block;">
                @livewire('editar-perfil')
            </div>
        </div>
    </div>
</section>
@endsection