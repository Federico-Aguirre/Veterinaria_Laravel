@extends('layouts.app')

@section('content')
    <section class="verMascota formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_mascota') }}">Agregar Mascota</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a></li>
                <li class="tab tab-tercera active"><a href="{{ route('ver_mascota') }}">Ver Mascota</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="ver-mascota">
                    <br />
                    <form id="selectMascotaForm">
                        <div class="contenedor-input">
                            <label>Selecciona una mascota para ver:</label>
                            <select name="id" id="mascotaSelect" required>
                                <option value="">Selecciona una mascota</option>
                                @foreach ($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}" 
                                            data-nombre="{{ $mascota->Nombre }}"
                                            data-raza="{{ $mascota->Raza }}"
                                            data-sexo="{{ $mascota->Sexo }}"
                                            data-edad="{{ $mascota->Edad }}"
                                            data-microchip="{{ $mascota->Nro_de_microchip }}"
                                            data-vacuna="{{ $mascota->Vacuna_antirrábica ? 'Sí' : 'No' }}"
                                            data-antiparasitario="{{ $mascota->Tratamiento_antiparasitario ? 'Sí' : 'No' }}"
                                            data-otras-vacunas="{{ $mascota->Otras_vacunas }}"
                                            data-info="{{ $mascota->Información_adicional }}">
                                        {{ $mascota->Nombre }} (ID: {{ $mascota->id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="button" class="button button-block" value="Seleccionar Mascota" onclick="mostrarMascota()">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function mostrarMascota() {
            var select = document.getElementById('mascotaSelect');
            var selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                var nombre = selectedOption.getAttribute('data-nombre');
                var raza = selectedOption.getAttribute('data-raza');
                var sexo = selectedOption.getAttribute('data-sexo');
                var edad = selectedOption.getAttribute('data-edad');
                var microchip = selectedOption.getAttribute('data-microchip');
                var vacuna = selectedOption.getAttribute('data-vacuna');
                var antiparasitario = selectedOption.getAttribute('data-antiparasitario');
                var otrasVacunas = selectedOption.getAttribute('data-otras-vacunas');
                var info = selectedOption.getAttribute('data-info');

                alert(`🐾 Mascota Seleccionada 🐾\n\n` +
                      `Nombre: ${nombre}\n` +
                      `Raza: ${raza}\n` +
                      `Sexo: ${sexo}\n` +
                      `Edad: ${edad} años\n` +
                      `Nro. de Microchip: ${microchip || 'No registrado'}\n` +
                      `Vacuna Antirrábica: ${vacuna}\n` +
                      `Tratamiento Antiparasitario: ${antiparasitario}\n` +
                      `Otras Vacunas: ${otrasVacunas || 'No especificado'}\n` +
                      `Información Adicional: ${info || 'No disponible'}`);
            } else {
                alert('Por favor selecciona una mascota.');
            }
        }
    </script>
@endsection
