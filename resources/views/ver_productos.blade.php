@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
    $perfilCompleto = Auth::check() &&
        $user->name &&
        $user->apellido &&
        $user->email &&
        $user->direccion &&
        $user->departamento &&
        $user->localidad &&
        $user->dni &&
        $user->cuil_cuit &&
        $user->piso !== null &&
        $user->created_at &&
        $user->updated_at;
@endphp

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

    <div class="productos__listado stock__tarjeta">
        @if(is_array($productos) && count($productos) > 0)
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
        @else
            <p>No hay productos disponibles.</p>
        @endif
    </div>

    <button id="btn-agregar-global" class="fixed bottom-[44px] left-1/2 transform -translate-x-1/2 bg-green hover:bg-skyBlue
        text-white font-bold py-2 px-4 rounded transition duration-300 w-[200px] z-50
        custom:top-1/2 custom:right-[250px] custom:left-auto custom:bottom-auto custom:transform custom:-translate-y-1/2 custom:translate-x-0">
        Agregar al carro
    </button>
</section>

<script>
    const isLoggedIn = @json(Auth::check());
    const perfilCompleto = @json($perfilCompleto);
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 JS embebido cargado");

    const contenedorProductos = document.querySelector(".productos__listado");
    const filtrosRef = document.querySelector(".stock__filtro__texto");
    const filtrosContenedor = document.querySelector(".stock__filtro__listaDeFiltros");
    let qa = new URLSearchParams(window.location.search).get('categoria');
    let q = new URLSearchParams(window.location.search).get('q');

    const cargarProductos = async (categoria = null, busqueda = null) => {
        try {
            let url = "/api/productos";
            const params = new URLSearchParams();

            if (categoria) url += `/${categoria}`;
            if (busqueda) params.append("q", busqueda);

            const finalUrl = params.toString() ? `${url}?${params.toString()}` : url;
            console.log("📡 URL pedida:", finalUrl);

            const respuesta = await fetch(finalUrl);
            const data = await respuesta.json();

            contenedorProductos.innerHTML = "";

            if (!data || data.length === 0) {
                contenedorProductos.innerHTML = "<p>No hay productos disponibles.</p>";
                return;
            }

            data.forEach(producto => {
                const caracteristicasHTML = producto.caracteristicas.map(c => `<li>${c}</li>`).join("");
                const productoHTML = `
                    <div class="producto stock__tarjeta__contenedor">
                        <img src="${producto.imagen}" class="stock__tarjeta__contenedor__imagen" alt="${producto.descripcion}" />
                        <div class="stock__tarjeta__contenedor__contenido">
                            <div class="stock__tarjeta__contenedor__contenido__descripcion">${producto.descripcion}</div>
                            <div class="stock__tarjeta__contenedor__contenido__precio">Precio: $${parseFloat(producto.precio).toFixed(2)}</div>
                            <div class="stock__tarjeta__contenedor__contenido__stock">Stock: ${producto.stock}</div>
                            <div class="stock__tarjeta__contenedor__contenido__caracteristicas">
                                <ul>${caracteristicasHTML}</ul>
                            </div>
                            <input type="number" name="producto_cantidad" value="" min="1" max="${producto.stock}"
                                placeholder="Cantidad" class="input-cantidad"
                                data-id="${producto.id}"
                                data-imagen="${producto.imagen}"
                                data-descripcion="${producto.descripcion}"
                                data-precio="${producto.precio}"
                                data-stock="${producto.stock}"
                                data-caracteristicas='${JSON.stringify(producto.caracteristicas)}'
                                data-categoria="${producto.categoria}">
                        </div>
                    </div>
                    <div class="linea"></div>
                `;
                contenedorProductos.innerHTML += productoHTML;
            });

        } catch (error) {
            console.error("❌ Error al cargar productos:", error);
            contenedorProductos.innerHTML = "<p>Error al cargar los productos.</p>";
        }
    };

    filtrosContenedor.addEventListener("click", (e) => {
        const boton = e.target.closest(".filtro-btn");
        if (!boton) return;

        e.preventDefault();
        const categoria = boton.getAttribute("data-categoria") || null;
        qa = categoria;

        filtrosRef.innerHTML = categoria ? `Filtrar por categoría: ${categoria}` : 'Todos los productos';
        cargarProductos(qa, q);
    });

    const buscarInput = document.querySelector("#busqueda");
    if (buscarInput) {
        buscarInput.addEventListener("input", (e) => {
            q = e.target.value;
            cargarProductos(qa, q);
        });
    }

    document.getElementById('btn-agregar-global').addEventListener('click', function () {
        if (!isLoggedIn) {
            alert("Debes loguearte para agregar un producto al carro.");
            window.location.href = "/login";
            return;
        }

        if (!perfilCompleto) {
            alert("Por favor completa tu perfil para poder continuar.");
            window.location.href = "/editar_perfil";
            return;
        }
        
        else {

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
        }
    });

    cargarProductos(qa, q);
});
</script>

@endsection
