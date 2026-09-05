import { $q, $qa } from './variablesGlobales';

document.addEventListener("DOMContentLoaded", () => {
    const contenedorProductos = $q(".productos__listado");
    const contenedorFiltros = $q(".stock__filtro__listaDeFiltros");

    // Si los contenedores de productos y filtros no existen en la página actual, salir silenciosamente
    if (!contenedorProductos && !contenedorFiltros) {
        return;
    }

    const filtrosRef = $q(".stock__filtro__texto");

    let qa = new URLSearchParams(window.location.search).get('categoria'); 
    let q = new URLSearchParams(window.location.search).get('q'); 

    const cargarProductos = async (categoria = null, busqueda = null) => {
        if (!contenedorProductos) return;

        try {
            let url = "/api/productos";
            const params = new URLSearchParams();

            if (categoria) {
                url += `/${categoria}`;
            }

            if (busqueda) {
                params.set("q", busqueda);
            }

            const finalUrl = params.toString() ? `${url}?${params.toString()}` : url;
            const respuesta = await fetch(finalUrl);
            const data = await respuesta.json();

            // Limpiar el contenedor
            contenedorProductos.innerHTML = "";

            if (data.length === 0) {
                contenedorProductos.innerHTML = "<p>No hay productos disponibles.</p>";
                return;
            }

            // Actualizar los productos en la vista
            data.forEach(producto => {
                const caracteristicasHTML = producto.caracteristicas.map(c => `<li>${c}</li>`).join("");
                const productoHTML = `
                    <div class="producto stock__tarjeta__contenedor">
                        <img src="${producto.imagen}" class="stock__tarjeta__contenedor__imagen" alt="${producto.descripcion}"/>
                        <div class="stock__tarjeta__contenedor__contenido">
                            <div class="stock__tarjeta__contenedor__contenido__descripcion">${producto.descripcion}</div>
                            <div class="stock__tarjeta__contenedor__contenido__precio">Precio: $${parseFloat(producto.precio).toFixed(2)}</div>
                            <div class="stock__tarjeta__contenedor__contenido__stock">Stock: ${producto.stock}</div>
                            <div class="stock__tarjeta__contenedor__contenido__caracteristicas">
                                <ul>${caracteristicasHTML}</ul>
                            </div>
                            <input type="number" name="producto_cantidad" value="" min="1" max="${producto.stock}" 
                                placeholder="Cantidad" class="input-cantidad" data-id="${producto.id}" 
                                data-imagen="${producto.imagen}" 
                                data-descripcion="${producto.descripcion}" 
                                data-precio="${producto.precio}" 
                                data-stock="${producto.stock}" 
                                data-caracteristicas='${JSON.stringify(producto.caracteristicas)}'>
                        </div>
                    </div>
                    <div class="linea"></div>
                `;
                contenedorProductos.innerHTML += productoHTML;
            });

        } catch (error) {
            console.error("Error al cargar productos:", error);
            if (contenedorProductos) {
                contenedorProductos.innerHTML = "<p>Error al cargar los productos.</p>";
            }
        }
    };

    // Configurar los botones de filtro sólo si el contenedor existe
    if (contenedorFiltros) {
        contenedorFiltros.addEventListener("click", (e) => {
            const boton = e.target.closest(".filtro-btn");
            if (!boton) return;

            e.preventDefault();
            const categoria = boton.getAttribute("data-categoria") || null;
            qa = categoria;
            if (filtrosRef) {
                filtrosRef.innerHTML = categoria ? `Filtrar por categoría: ${categoria}` : 'Todos los productos';
            }
            cargarProductos(qa, q);
        });
    }

    // Agregar evento para el filtro de búsqueda
    const buscarInput = $q("#busqueda");
    if (buscarInput) {
        buscarInput.addEventListener("input", (e) => {
            q = e.target.value;
            cargarProductos(qa, q);
        });
    }

    cargarProductos(qa, q);
});