document.addEventListener('DOMContentLoaded', function () {
    const borrarPerfilButton = document.getElementById('borrarPerfilButton');
    
    // Si el botón no existe en la página actual, salir silenciosamente sin emitir errores
    if (!borrarPerfilButton) {
        return;
    }

    // Seleccionar el token CSRF sólo cuando el botón está presente
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

    if (!csrfToken) {
        console.error('El atributo content del CSRF token no está presente o está vacío.');
        return;
    }

    // evento click
    borrarPerfilButton.addEventListener('click', function () {
        if (confirm('¿Estás seguro de que deseas borrar tu perfil? Esta acción no se puede deshacer.')) {
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
                window.location.href = '/';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al borrar el perfil.');
            });
        }
    });
});