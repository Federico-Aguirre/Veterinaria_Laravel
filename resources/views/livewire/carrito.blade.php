<li class="header__carroDeCompra relative">
    {{-- Enlace directo al carrito de compras --}}
    <a href="{{ route('carro_de_compras') }}" class="carro-container flex items-center gap-2 focus:outline-none">
        <img src="{{ asset('imagenes/iconos/shopping-cart.svg') }}" class="header__carroDeCompra__button" />
        <span id="contador-carrito" class="header__carroDeCompra__cantidad">
            {{ $cantidad }}
        </span>
    </a>
</li>