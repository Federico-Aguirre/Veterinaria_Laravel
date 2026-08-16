<li class="header__carroDeCompra relative">
    {{-- Enlace directo al carrito de compras con texto accesible para lectores de voz --}}
    <a href="{{ route('carro_de_compras') }}" 
       class="carro-container flex items-center gap-2 focus:outline-none"
       aria-label="Ir al carrito de compras. Tienes {{ $cantidad }} artículos añadidos.">
       
        {{-- Imagen optimizada para evitar saltos de layout (CLS) --}}
        <img src="{{ asset('imagenes/iconos/shopping-cart.svg') }}" 
             class="header__carroDeCompra__button" 
             alt="" 
             aria-hidden="true" 
             width="24" 
             height="24" 
             decoding="async" />
             
        {{-- Contador visual (oculto para lectores de voz para evitar redundancia) --}}
        <span id="contador-carrito" 
              class="header__carroDeCompra__cantidad"
              aria-hidden="true">
            {{ $cantidad }}
        </span>
    </a>
</li>