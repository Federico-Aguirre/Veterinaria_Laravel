<div x-data="{
        categoria: @entangle('categoria'),
        busqueda: @entangle('busqueda'),
        isLoggedIn: @json(Auth::check()),
        perfilCompleto: @json($perfilCompleto),
    }"
    class="productos stock seccion"
>
    <!-- Filtros -->
    <div class="stock__filtro">
        <div class="stock__filtro__texto">
            Filtrar por categoría:
            <span x-text="categoria ? categoria.charAt(0).toUpperCase() + categoria.slice(1) : 'Sin filtro'"></span>
        </div>
        <div class="stock__filtro__listaDeFiltros">
            <button class="filtro-btn" @click="categoria = null; $wire.setCategoria(null)">Sin filtro</button>
            @foreach(['alimentos', 'camas', 'juguetes', 'transportadoras', 'otros'] as $cat)
                <button class="filtro-btn" @click="categoria = '{{ $cat }}'; $wire.setCategoria('{{ $cat }}')">
                    {{ ucfirst($cat) }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Listado de productos -->
    <div class="productos__listado stock__tarjeta">
        @if(count($productos) > 0)
            @foreach($productos as $producto)
                <div class="producto stock__tarjeta__contenedor">
                    <img src="{{ $producto['imagen'] }}" class="stock__tarjeta__contenedor__imagen"/>
                    <div class="stock__tarjeta__contenedor__contenido">
                        <div class="stock__tarjeta__contenedor__contenido__descripcion">{{ $producto['descripcion'] }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__precio">Precio: ${{ number_format($producto['precio'], 2) }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__stock">Stock: {{ $producto['stock'] }}</div>
                        <div class="stock__tarjeta__contenedor__contenido__caracteristicas">
                            <ul>
                                @foreach($producto['caracteristicas'] as $caracteristica)
                                    <li>{{ $caracteristica }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <input type="number"
                            name="producto_cantidad"
                            min="1"
                            max="{{ $producto['stock'] }}"
                            placeholder="Cantidad"
                            data-id="{{ $producto['id'] }}"
                            data-imagen="{{ $producto['imagen'] }}"
                            data-descripcion="{{ $producto['descripcion'] }}"
                            data-precio="{{ $producto['precio'] }}"
                            data-stock="{{ $producto['stock'] }}"
                            data-caracteristicas="{{ json_encode($producto['caracteristicas']) }}"
                            data-categoria="{{ $producto['categoria'] }}"
                            class="input-cantidad"
                        >
                    </div>
                </div>
                <div class="linea"></div>
            @endforeach
        @else
            <p>No hay productos disponibles.</p>
        @endif
    </div>

    <!-- Botón agregar al carro -->
    <button class="fixed left-1/2 bg-green hover:bg-skyBlue
        text-white font-bold py-2 px-4 rounded transition duration-300 w-[200px] z-50"
        style="bottom: 45px; transform: translateX(-50%);"
        @click="
            if(!isLoggedIn) { alert('Debes loguearte para agregar un producto al carro.'); window.location.href='/login'; return; }
            if(!perfilCompleto) { alert('Por favor completa tu perfil para poder continuar.'); window.location.href='/editar_perfil'; return; }

            let productos = [];
            document.querySelectorAll('.producto').forEach(p => {
                let input = p.querySelector('input[name=producto_cantidad]');
                let cantidad = input.value;
                if(!cantidad || cantidad < 1) return;

                let caracteristicas = [];
                try { caracteristicas = JSON.parse(input.dataset.caracteristicas) || []; } catch(e){}

                productos.push({
                    producto_id: input.dataset.id,
                    producto_cantidad: cantidad,
                    producto_imagen: input.dataset.imagen,
                    producto_descripcion: input.dataset.descripcion,
                    producto_precio: input.dataset.precio,
                    producto_stock: input.dataset.stock,
                    producto_caracteristicas: caracteristicas,
                    producto_categoria: input.dataset.categoria
                });
            });

            if(productos.length === 0){ alert('Escriba la cantidad deseada para al menos un producto.'); return; }

            const csrfToken = document.querySelector('meta[name=csrf-token]').getAttribute('content');

            fetch('{{ route('agregar_al_carro') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
                body: JSON.stringify({ productos })
            })
            .then(res => res.json())
            .then(data => { if(data.success){ alert('Productos agregados al carrito.'); location.reload(); } else { alert('Error: ' + data.error); } })
            .catch(err => console.error(err));
        "
    >
        Agregar al carro
    </button>
</div>