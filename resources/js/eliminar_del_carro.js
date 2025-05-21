document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.eliminar-btn');

    botonesEliminar.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            const productoId = this.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar este producto del carro?')) {
                fetch(`/carro/remover/${productoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar producto del DOM
                        document.getElementById(`producto-${productoId}`).remove();

                        // Actualizar contador
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
