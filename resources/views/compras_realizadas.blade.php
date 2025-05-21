@extends('layouts.app')

@section('content')
    <section class="carro seccion flex flex-col items-center mt-[15vh]">
        @if($compras->isEmpty())
            <p>No hay compras realizadas.</p>
        @else
            <div class="productos__listado stock__tarjeta">
                @foreach($compras as $compra)
                    <div class="producto stock__tarjeta__contenedor">
                        <img src="{{ $compra->producto_imagen }}" class="stock__tarjeta__contenedor__imagen" alt="Producto">
                        <div class="stock__tarjeta__contenedor__contenido">
                            <div class="stock__tarjeta__contenedor__contenido__descripcion">{{ $compra->producto_descripcion }}</div>
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
