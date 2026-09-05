@extends('layouts.app')

@section('content')
<section class="seccion productos stock" aria-labelledby="titulo-carro">
    <h1 id="titulo-carro">Mi Carro</h1>

    @if($productos->isEmpty())
        <p>No hay productos en el carrito.</p>
    @else
        <div class="productos__listado stock__tarjeta">
            @foreach($productos as $producto)
                <div class="producto stock__tarjeta__contenedor" id="producto-{{ $producto->id }}">
                    <x-picture 
                        src="{{ $producto->producto_imagen }}" 
                        alt="{{ $producto->producto_descripcion }}" 
                        class="stock__tarjeta__contenedor__imagen"
                        loading="lazy"
                        decoding="async"
                    />
                    <div class="stock__tarjeta__contenedor__contenido">
                        <div class="stock__tarjeta__contenedor__contenido__descripcion" role="heading" aria-level="2">
                            {{ $producto->producto_descripcion }}
                        </div>
                        <div class="stock__tarjeta__contenedor__contenido__precio">Precio unitario: ${{ number_format($producto->producto_precio, 2, ',', '.') }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__cantidad">Cantidad: {{ $producto->producto_cantidad }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__subtotal">Subtotal: ${{ number_format($producto->producto_precio_total, 2, ',', '.') }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__caracteristicas">
                            <ul>
                                @if($producto->producto_caracteristicas_1) <li>{{ $producto->producto_caracteristicas_1 }}</li> @endif
                                @if($producto->producto_caracteristicas_2) <li>{{ $producto->producto_caracteristicas_2 }}</li> @endif
                                @if($producto->producto_caracteristicas_3) <li>{{ $producto->producto_caracteristicas_3 }}</li> @endif
                                @if($producto->producto_caracteristicas_4) <li>{{ $producto->producto_caracteristicas_4 }}</li> @endif
                                @if($producto->producto_caracteristicas_5) <li>{{ $producto->producto_caracteristicas_5 }}</li> @endif
                            </ul>
                        </div>
                        <button 
                            type="button"
                            class="btn btn-danger btn-sm eliminar-btn col-start-2 row-start-[-1] mt-2 h-[40px] rounded w-[100px] justify-self-start bg-green text-white" 
                            data-id="{{ $producto->id }}"
                            aria-label="Eliminar {{ $producto->producto_descripcion }} del carrito"
                        >
                            🗑️ Eliminar
                        </button>
                    </div>
                </div>
                <div class="linea"></div>
            @endforeach
        </div>

        <div class="total-pagar" role="status">
            Total a pagar: $<span id="amount" data-value="{{ $total }}">{{ $total }}</span>
        </div>

        <div id="paypal-button-container"></div>
    @endif
</section>
@endsection

@section('scripts')
    {{-- Carga diferida del SDK de PayPal para no bloquear el renderizado inicial --}}
    <script src="https://www.paypal.com/sdk/js?client-id=AZL3i6QxDcfN07Xvy9HtUZ9humz03Sn0S24Q_lM097VbNfZ0FNP7dH3PeMG-TIRufI1JPPSCN5WfeiCY&currency=USD" defer></script>
    @vite('resources/js/paypal.js')
@endsection