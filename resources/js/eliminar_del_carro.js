document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.eliminar-btn');

    botonesEliminar.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            const productoId = this.dataset.id;

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            if (confirm('¿Estás seguro de que deseas eliminar este producto del carro?')) {
                fetch(`/carro/remover/${productoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const elementoProducto = document.getElementById(`producto-${productoId}`);
                        if (elementoProducto) {
                            elementoProducto.remove();
                        }

                        const contador = document.getElementById('contador-carrito');
                        if (contador && data.nuevaCantidad !== undefined) {
                            contador.textContent = data.nuevaCantidad;
                        }
                    } else {
                        alert(data.message || 'Error al eliminar el producto');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al intentar eliminar el producto.');
                });
            }
        });
    });
});