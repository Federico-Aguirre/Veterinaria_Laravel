document.addEventListener('DOMContentLoaded', function () {
    const amountElement = document.getElementById('amount');
    const paypalContainer = document.getElementById('paypal-button-container');

    if (!amountElement || !paypalContainer || typeof paypal === 'undefined') {
        console.error('PayPal no está disponible o faltan elementos');
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
                // Antes de redirigir, actualizamos el carrito
                fetch('/obtenerCantidadProductosEnCarro')
                    .then(res => res.json())
                    .then(data => {

                        // Ahora, finalizamos la compra
                        fetch('/finalizar-compra', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const contadorCarrito = document.getElementById('contador-carrito');
                                const carroContainer = document.querySelector('.carro-container');
                            
                                // Forzamos repintado (opcional, pero útil en navegadores que lo necesiten)
                                void contadorCarrito.offsetHeight;
                            
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
