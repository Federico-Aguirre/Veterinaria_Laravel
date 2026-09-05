document.addEventListener('DOMContentLoaded', function () {
    const btnAgregarCarro = document.getElementById('btn-agregar-carro');

    // Si el botón no existe en la página actual, salir en silencio
    if (!btnAgregarCarro) {
        return;
    }

    btnAgregarCarro.addEventListener('click', function (event) {
        event.preventDefault();

        let hayProductosValidos = false;
        const inputsCantidad = document.querySelectorAll('input[name*="cantidad"]');
        
        inputsCantidad.forEach(input => {
            if (parseInt(input.value) > 0) {
                hayProductosValidos = true;
            }
        });

        if (!hayProductosValidos) {
            alert('Debes seleccionar al menos un producto con cantidad mayor a 0.');
        } else {
            const formAgregarCarro = document.getElementById('form-agregar-carro');
            if (formAgregarCarro) {
                formAgregarCarro.submit();
            }
        }
    });
});