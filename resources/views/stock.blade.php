@extends('layouts.app')

@section('content')
    <section class="stock seccion" aria-label="Catálogo de productos">
        {{-- Titular H1 accesible para jerarquía semántica --}}
        <h1 class="sr-only">Stock y Catálogo de Productos</h1>

        <div class="stock__filtro">
            <h2 class="stock__filtro__texto">Filtrar por categoria: Alimentos</h2>
            <div class="stock__filtro__listaDeFiltros" role="group" aria-label="Filtros de categoría">
                <button type="button" id="filtro0">Sin filtro</button>
                <button type="button" id="filtro1">Alimentos</button>
                <button type="button" id="filtro2">Camas</button>
                <button type="button" id="filtro3">Juguetes</button>
                <button type="button" id="filtro4">Transportadoras</button>
                <button type="button" id="filtro5">Otros</button>
            </div>
        </div>
        {{-- Área dinámica con aria-live para notificar cambios a tecnologías de asistencia --}}
        <div class="stock__tarjeta" aria-live="polite"></div>
        <div class="linea"></div>
    </section>
@endsection