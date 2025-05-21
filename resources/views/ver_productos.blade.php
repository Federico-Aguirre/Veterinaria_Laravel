@extends('layouts.app')

@section('content')
    <section class="productos stock seccion">
        <div class="stock__filtro">
            <div class="stock__filtro__texto">
                Filtrar por categoría: 
                @if(request()->has('categoria'))
                    {{ ucfirst(request()->categoria) }}
                @else
                    Sin filtro
                @endif
            </div>
            <div class="stock__filtro__listaDeFiltros">
                <button id="filtro0" class="filtro-btn">Sin filtro</button>
                @foreach(['alimentos', 'camas', 'juguetes', 'transportadoras', 'otros'] as $categoria)
                    <button id="filtro{{ $loop->index + 1 }}" class="filtro-btn" data-categoria="{{ $categoria }}">
                        {{ ucfirst($categoria) }}
                    </button>
                @endforeach
            </div>
        </div>

        @if(is_array($productos) && count($productos) > 0)
            <div class="productos__listado stock__tarjeta">
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
                            <input type="number" name="producto_cantidad" value="" min="1" max="{{ $producto['stock'] }}" 
                                placeholder="Cantidad" class="input-cantidad" data-id="{{ $producto['id'] }}" 
                                data-imagen="{{ $producto['imagen'] }}" 
                                data-descripcion="{{ $producto['descripcion'] }}" 
                                data-precio="{{ $producto['precio'] }}" 
                                data-stock="{{ $producto['stock'] }}" 
                                data-caracteristicas="{{ json_encode($producto['caracteristicas']) }}"
                                data-categoria="{{ $producto['categoria'] }}"
                            >
                        </div>
                    </div>
                    <div class="linea"></div>
                @endforeach
            </div>

            <button id="btn-agregar-global" class="
                fixed bottom-[44px] left-1/2 transform -translate-x-1/2 bg-green hover:bg-skyBlue
                text-white font-bold py-2 px-4 rounded transition duration-300 w-[200px] z-50
                custom:top-1/2 custom:right-[210px] custom:left-auto custom:bottom-auto custom:transform custom:-translate-y-1/2 custom:translate-x-0"
            >Agregar al carro</button>

        @else
            <p>No hay productos disponibles.</p>
        @endif
    </section>

    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    <!-- Script para manejar el botón global -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-agregar-global').addEventListener('click', function() {
            const isLoggedIn = JSON.parse("{{ Auth::check() ? 'true' : 'false' }}");

            if (!isLoggedIn) {
                alert("Debes logearte para agregar un producto al carro.");
                return;
            }

            // Código si está logueado
            let productos = [];

            document.querySelectorAll('.producto').forEach(producto => {
                let inputCantidad = producto.querySelector('input[name="producto_cantidad"]');
                let cantidad = inputCantidad.value;

                if (!cantidad || cantidad < 1) return;

                let caracteristicas = [];
                try {
                    caracteristicas = JSON.parse(inputCantidad.getAttribute('data-caracteristicas')) || [];
                } catch (error) {
                    console.error("Error al parsear características:", error);
                }

                productos.push({
                    producto_id: inputCantidad.getAttribute('data-id'),
                    producto_cantidad: cantidad,
                    producto_imagen: inputCantidad.getAttribute('data-imagen'),
                    producto_descripcion: inputCantidad.getAttribute('data-descripcion'),
                    producto_precio: inputCantidad.getAttribute('data-precio'),
                    producto_stock: inputCantidad.getAttribute('data-stock'),
                    producto_caracteristicas: caracteristicas,
                    producto_categoria: inputCantidad.getAttribute('data-categoria')
                });
            });

            if (productos.length === 0) {
                alert("Escriba la cantidad deseada para al menos un producto.");
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('agregar_al_carro') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ productos })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                if (data.success) {
                    alert("Productos agregados al carrito.");
                    location.reload();
                } else {
                    alert("Error: " + data.error);
                }
            })
            .catch(error => {
                console.error("Error en la petición:", error);
            });
        });
    });
</script>

@endsection

@section('scripts')
    @vite(['resources/js/filtros.js', 'resources/js/agregarAlCarro.js'])
@endsection