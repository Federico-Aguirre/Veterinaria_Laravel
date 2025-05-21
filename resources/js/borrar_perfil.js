document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar el token CSRF del meta tag
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        console.error('El meta CSRF token no está presente en el DOM.');
        return;
    }

    const csrfToken = csrfTokenMeta.getAttribute('content');
    if (!csrfToken) {
        console.error('El atributo content del CSRF token está vacío.');
        return;
    }

    // Seleccionar el botón "Borrar Perfil"
    const borrarPerfilButton = document.getElementById('borrarPerfilButton');
    if (!borrarPerfilButton) {
        console.error('No se encontró el botón con ID "borrarPerfilButton".');
        return;
    }

    // Agregar evento click al botón
    borrarPerfilButton.addEventListener('click', function () {
        // Mostrar alerta personalizada
        if (confirm('¿Estás seguro de que deseas borrar tu perfil? Esta acción no se puede deshacer.')) {
            // Enviar solicitud al servidor para borrar el perfil
            fetch('/borrar_perfil', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message || 'Perfil borrado exitosamente.');
                // Redirigir al usuario a la página de inicio
                window.location.href = '/';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al borrar el perfil.');
            });
        }
    });
});