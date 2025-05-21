@extends('layouts.app')

@section('content')
    <section class="borrarMascota formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_mascota') }}">Agregar Mascota</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_mascota') }}">Ver Mascota</a></li>
                <li class="tab tab-cuarta active"><a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="borrar-mascota">
                    <br />

                    <!-- Seleccionar una mascota para borrar -->
                    <form method="GET" id="selectMascotaForm">
                        <div class="contenedor-input">
                            <label>Selecciona una mascota para borrar:</label>
                            <select name="id" id="mascotaSelect" required>
                                <option value="">Selecciona una mascota</option>
                                @foreach ($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}">
                                        {{ $mascota->Nombre }} (ID: {{ $mascota->id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="button" class="button button-block" onclick="borrarMascota()">Borrar Mascota</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function borrarMascota() {
            var mascotaId = document.getElementById('mascotaSelect').value;

            if (!mascotaId) {
                alert('Por favor, selecciona una mascota.');
                return;
            }

            if (!confirm('¿Estás seguro de que quieres borrar esta mascota?')) {
                return;
            }

            fetch(`/borrar_mascota/${mascotaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Mascota eliminada correctamente.');
                    location.reload();
                } else {
                    alert('Error al eliminar la mascota.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection