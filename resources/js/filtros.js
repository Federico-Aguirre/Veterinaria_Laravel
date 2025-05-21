// Importar los selectores globales
import { $q, $qa } from './variablesGlobales';

document.addEventListener("DOMContentLoaded", () => {
    const contenedorProductos = $q(".productos__listado");
    const filtrosRef = $q(".stock__filtro__texto");

    // Variables para la categoría (qa) y la búsqueda (q)
    let qa = new URLSearchParams(window.location.search).get('categoria'); // Obtiene la categoría de la URL (si existe)
    let q = new URLSearchParams(window.location.search).get('q'); // Obtiene la búsqueda de la URL (si existe)

    const cargarProductos = async (categoria = null, busqueda = null) => {
        try {
            let url = "/api/productos"; // URL sin categoría inicial
            // Si hay categoría o búsqueda, se agregan a la URL
            if (categoria) {
                url += `/${categoria}`;
            }
            if (busqueda) {
                url += `?q=${busqueda}`;
            }

            const respuesta = await fetch(url);
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
            contenedorProductos.innerHTML = "<p>Error al cargar los productos.</p>";
        }
    };

    // Configurar los botones de filtro
    const botonesFiltro = $qa(".filtro-btn"); // obtener todos los botones
    botonesFiltro.forEach(boton => {
        boton.addEventListener("click", (e) => {
            e.preventDefault(); // Evitar recargar la página
            const categoria = boton.getAttribute("data-categoria");
            qa = categoria; // Actualizar la categoría seleccionada
            filtrosRef.innerHTML = categoria ? `Filtrar por categoría: ${categoria}` : 'Todos los productos';
            cargarProductos(qa, q); // Cargar productos filtrados por categoría
        });
    });

    // Agregar evento para el filtro de búsqueda
    const buscarInput = $q("#busqueda");
    if (buscarInput) {
        buscarInput.addEventListener("input", (e) => {
            q = e.target.value; // Capturar el texto de búsqueda
            cargarProductos(qa, q); // Cargar productos filtrados por búsqueda
        });
    }

    cargarProductos(qa, q); // Cargar productos al inicio con la categoría y búsqueda actual
});
