@extends('layouts.app')

@section('content')
    <section class="carro seccion flex flex-col items-center mt-[15vh]" aria-label="Historial de compras">
        {{-- Encabezado H1 accesible para la jerarquía semántica del sitio --}}
        <h1 class="sr-only">Mis Compras Realizadas</h1>

        @if($compras->isEmpty())
            <p>No hay compras realizadas.</p>
        @else
            <div class="productos__listado stock__tarjeta">
                @foreach($compras as $compra)
                    <div class="producto stock__tarjeta__contenedor">
                        {{-- Corrección de sintaxis de Blade y optimización de carga diferida --}}
                        <x-picture 
                            src="{{ $compra->producto_imagen }}" 
                            alt="{{ $compra->producto_descripcion }}" 
                            class="stock__tarjeta__contenedor__imagen"
                            loading="lazy"
                            decoding="async"
                        />
                        <div class="stock__tarjeta__contenedor__contenido">
                            <div class="stock__tarjeta__contenedor__contenido__descripcion" role="heading" aria-level="2">
                                {{ $compra->producto_descripcion }}
                            </div>
                            <div class="stock__tarjeta__contenedor__contenido__cantidad">Cantidad: {{ $compra->producto_cantidad }}</div>
                            <div class="stock__tarjeta__contenedor__contenido__precio">Precio Unitario: ${{ number_format($compra->producto_precio, 2, ',', '.') }}</div>
                            <div class="stock__tarjeta__contenedor__contenido__precio">Total: ${{ number_format($compra->producto_precio_total, 2, ',', '.') }}</div>
                            <div class="stock__tarjeta__contenedor__contenido__fecha">Fecha: {{ $compra->fecha_de_compra }}</div>
                            <div class="stock__tarjeta__contenedor__contenido__caracteristicas">
                                <ul>
                                    @foreach (range(1, 5) as $i)
                                        @php
                                            $campo = "producto_caracteristicas_$i";
                                        @endphp
                                        @if (!empty($compra->$campo))
                                            <li>{{ $compra->$campo }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="linea"></div>
                @endforeach
            </div>
        @endif
    </section>
@endsection