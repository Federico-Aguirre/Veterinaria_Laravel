@extends('layouts.app')

@section('content')
<section class="seccion-login" aria-label="Iniciar sesión">
    {{-- Titular H1 accesible para la jerarquía semántica de la página --}}
    <h1 class="sr-only">Iniciar Sesión</h1>

    @livewire('login')
</section>
@endsection