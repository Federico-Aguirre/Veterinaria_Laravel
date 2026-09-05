@extends('layouts.app')

@section('content')
<section class="seccion-registro" aria-label="Registro de usuario">
    {{-- Titular H1 accesible para la jerarquía semántica de la página --}}
    <h1 class="sr-only">Crear Cuenta</h1>

    @livewire('agregar-usuario')
</section>
@endsection