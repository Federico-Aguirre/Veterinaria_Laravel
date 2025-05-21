document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn-agregar-carro').addEventListener('click', function (event) {
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
            document.getElementById('form-agregar-carro').submit();
        }
    });
});
