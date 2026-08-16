document.addEventListener('DOMContentLoaded', function () {
    const amountElement = document.getElementById('amount');
    const paypalContainer = document.getElementById('paypal-button-container');

    // Si los elementos de PayPal no están en la vista actual, salir en silencio sin registrar errores en consola
    if (!amountElement || !paypalContainer || typeof paypal === 'undefined') {
        return;
    }

    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amountElement.getAttribute('data-value')
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                // Obtener token CSRF de forma segura
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

                // Antes de redirigir, actualizamos el carrito
                fetch('/obtenerCantidadProductosEnCarro', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin'
                })
                .then(res => res.json())
                .then(data => {
                    // Finalizar la compra
                    fetch('/finalizar-compra', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({})
                    })
                    .then(res => {
                        if (!res.ok) {
                            return res.text();
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const contadorCarrito = document.getElementById('contador-carrito');
                            if (contadorCarrito) {
                                void contadorCarrito.offsetHeight; // Forzar repintado si existe
                            }

                            alert('Compra realizada con éxito.');
                            window.location.href = data.redirect;
                        } else {
                            alert('Hubo un error al finalizar la compra.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al procesar la compra.');
                    });
                })
                .catch(error => {
                    console.error('Error al obtener la cantidad del carrito:', error);
                    alert('Hubo un error al intentar actualizar el carrito.');
                });
            });
        }
    }).render('#paypal-button-container');
});