document.addEventListener('DOMContentLoaded', function () {
    const verPerfilBtn = document.getElementById('ver-perfil-btn');
    if (verPerfilBtn) {
        verPerfilBtn.addEventListener('click', function () {
            fetch('/ver_perfil', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let userData = `
                    Nombre: ${data.name}
                    Apellido: ${data.Apellido}
                    Dirección: ${data.Dirección}
                    Piso: ${data.Piso}
                    Departamento: ${data.Departamento}
                    Localidad: ${data.Localidad}
                    Teléfono: ${data.Teléfono}
                    Celular: ${data.Celular}
                    Email: ${data.email}
                `;
                alert(userData);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al obtener los datos del perfil.');
            });
        });
    }
});
