import { $q } from './variablesGlobales';

document.addEventListener('DOMContentLoaded', function () {
    let fecha = new Date();
    let diaActual = fecha.getDate();
    let mesActual = fecha.getMonth() + 1;
    let añoActual = fecha.getUTCFullYear();

    if (diaActual < 10) diaActual = '0' + diaActual;
    if (mesActual < 10) mesActual = '0' + mesActual;

    let minDate = `${añoActual}-${mesActual}-${diaActual}T00:00`;
    let maxDate = `${añoActual + 2}-${mesActual}-${diaActual}T23:59`;

    const dateElement = $q(".turnos__formulario__fecha");
    const fechaInput = document.getElementById('fecha');

    if (fechaInput) {
        fechaInput.addEventListener('click', function () {
            fechaInput.showPicker(); 
        });
    }

    if (dateElement) {
        dateElement.setAttribute('min', minDate);
        dateElement.setAttribute('max', maxDate);
        dateElement.setAttribute('step', '1800');

        dateElement.addEventListener("input", function () {
            let fechaSeleccionada = new Date(dateElement.value);
            let minutos = fechaSeleccionada.getMinutes();

            if (minutos % 30 !== 0) {
                alert("Solo puedes seleccionar horarios en intervalos de 30 minutos (por ejemplo, 13:00, 13:30, 14:00, etc.).");
                dateElement.value = "";
            }
        });

        dateElement.addEventListener('change', function () {
            const fechaSeleccionada = dateElement.value;

            fetch('/verificar-turno', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ fecha: fechaSeleccionada })
            })
            .then(response => response.json())
            .then(data => {
                if (data.ocupado) {
                    alert("Ya existe un turno en esta fecha y hora. Por favor, selecciona otra.");
                    dateElement.value = '';
                }
            });
        });
    }
});
