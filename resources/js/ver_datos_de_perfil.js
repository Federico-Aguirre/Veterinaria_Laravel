document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('ver-perfil-btn').addEventListener('click', function () {
        fetch('/ver-perfil')
            .then(response => response.json())
            .then(data => {
                let mensaje = `
                    Nombre: ${data.name}
                    Apellido: ${data.apellido}
                    Dirección: ${data.direccion}
                    Piso: ${data.piso}
                    Departamento: ${data.departamento}
                    Localidad: ${data.localidad}
                    Teléfono: ${data.telefono}
                    Celular: ${data.celular}
                    Email: ${data.email}
                `;
                alert(mensaje);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al obtener el perfil');
            });
    });
});