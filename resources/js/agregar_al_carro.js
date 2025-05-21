document.addEventListener("DOMContentLoaded", () => {
    const btnAgregar = $q("#btn-agregar-global");

    btnAgregar.addEventListener("click", async () => {
        const inputsCantidad = $qa(".input-cantidad");
        const productos = [];

        inputsCantidad.forEach(input => {
            const cantidadStr = input.value.trim();
            const cantidad = parseInt(cantidadStr);

            if (!cantidadStr || isNaN(cantidad) || cantidad <= 0) {
                if (cantidadStr !== "") {
                    alert("Cantidad inválida para el producto: " + input.dataset.descripcion);
                }
                return;
            }

            const caracteristicas = JSON.parse(input.dataset.caracteristicas || "[]");

            productos.push({
                producto_id: parseInt(input.dataset.id),
                producto_categoria: input.dataset.categoria,
                producto_cantidad: cantidad,
                producto_imagen: input.dataset.imagen,
                producto_descripcion: input.dataset.descripcion,
                producto_precio: parseFloat(input.dataset.precio),
                producto_stock: parseInt(input.dataset.stock),
                producto_caracteristicas: caracteristicas
            });
        });

        if (productos.length === 0) {
            alert("Por favor ingresa una cantidad válida mayor a 0 para al menos un producto.");
            return;
        }

        try {
            const respuesta = await fetch("/carro/agregar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ productos })
            });

            const resultado = await respuesta.json();
            if (resultado.success) {
                alert("Productos agregados al carrito correctamente.");
                inputsCantidad.forEach(input => input.value = ""); // Limpiar inputs
                window.location.href = resultado.redirect;  // Redirigir después de la compra
            } else {
                alert("Error: " + resultado.error);
            }
        } catch (error) {
            console.error("Error al enviar productos:", error);
            alert("Ocurrió un error al intentar agregar los productos.");
        }
    });

