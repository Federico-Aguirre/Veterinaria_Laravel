@extends('layouts.app')

@section('content')
<section class="seccion-ver-productos" aria-label="Catálogo de productos">
    {{-- Titular H1 accesible para la jerarquía semántica y SEO --}}
    <h1 class="sr-only">Catálogo de Productos</h1>

    @livewire('ver-productos')
</section>
@endsection