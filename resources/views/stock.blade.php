@extends('layouts.app')

@section('content')
    <section class="stock seccion">
        <div class="stock__filtro">
            <div class="stock__filtro__texto">Filtrar por categoria: Alimentos</div>
            <div class="stock__filtro__listaDeFiltros">
                <button id="filtro0">Sin filtro</button>
                <button id="filtro1">Alimentos</button>
                <button id="filtro2">Camas</button>
                <button id="filtro3">Juguetes</button>
                <button id="filtro4">Transportadoras</button>
                <button id="filtro5">Otros</button>
            </div>
        </div>
        <div class="stock__tarjeta"></div>
        <div class="linea"></div>
    </section>
@endsection