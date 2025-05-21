@extends('layouts.app')

@if(session('mascota_actualizada_exitosamente'))
    <script>
        alert("{{ session('mascota_actualizada_exitosamente') }}");
    </script>
@endif

@section('content')
    <section class="editarMascota formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera"><a href="{{ route('agregar_mascota') }}">Agregar Mascota</a></li>
                <li class="tab tab-segunda active"><a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_mascota') }}">Ver Mascota</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a></li>
            </ul>

            <div class="contenido-tab">
                <br />
                <!-- Si no se pasa un id, mostrar el select de mascotas -->
                @if(!isset($mascota))
                    <form method="GET" id="selectMascotaForm">
                        <div class="contenedor-input">
                            <label>Selecciona una mascota para editar:</label>
                            <select name="id" id="mascotaSelect" required>
                                <option value="">Selecciona una mascota</option>
                                @foreach ($mascotas as $mascotaSelect)
                                    <option value="{{ $mascotaSelect->id }}">{{ $mascotaSelect->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="button" class="button button-block" value="Seleccionar Mascota" onclick="redirectToEditPage()">
                    </form>
                @else
                    <!-- Formulario de edición -->
                    <form id="registerForm" action="{{ route('editar_mascota_update', ['id' => $mascota->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="contenedor-input">
                            <label>Nombre de la mascota<span class="req">*</span></label>
                            <input type="text" name="Nombre" value="{{ old('Nombre', $mascota->Nombre) }}" required>
                            @error('Nombre') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Raza<span class="req">*</span></label>
                            <input type="text" name="Raza" value="{{ old('Raza', $mascota->Raza) }}" required>
                            @error('Raza') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Sexo<span class="req">*</span></label>
                            <input type="text" name="Sexo" value="{{ old('Sexo', $mascota->Sexo) }}" required>
                            @error('Sexo') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Edad<span class="req">*</span></label>
                            <input type="number" name="Edad" value="{{ old('Edad', $mascota->Edad) }}" required>
                            @error('Edad') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Nro. de microchip</label>
                            <input type="text" name="Nro_de_microchip" value="{{ old('Nro_de_microchip', $mascota->Nro_de_microchip) }}">
                            @error('Nro_de_microchip') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Vacuna antirrábica</label>
                            <input type="checkbox" name="Vacuna_antirrábica" value="1" {{ $mascota->Vacuna_antirrábica ? 'checked' : '' }}>
                            @error('Vacuna_antirrábica') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Tratamiento antiparasitario</label>
                            <input type="checkbox" name="Tratamiento_antiparasitario" value="1" {{ $mascota->Tratamiento_antiparasitario ? 'checked' : '' }}>
                            @error('Tratamiento_antiparasitario') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Otras vacunas</label>
                            <input type="text" name="Otras_vacunas" value="{{ old('Otras_vacunas', $mascota->Otras_vacunas) }}">
                            @error('Otras_vacunas') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="contenedor-input">
                            <label>Información adicional</label>
                            <input type="text" name="Información_adicional" value="{{ old('Información_adicional', $mascota->Información_adicional) }}">
                            @error('Información_adicional') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <input type="submit" class="button button-block" value="Editar mascota">
                    </form>
                @endif
            </div>
        </div>
    </section>

    <script>
        // Función para redirigir al hacer clic en el botón
        function redirectToEditPage() {
            var selectedId = document.getElementById('mascotaSelect').value;
            if (selectedId) {
                window.location.href = "{!! url('/editar_mascota') !!}/" + selectedId;
            } else {
                alert('Por favor selecciona una mascota.');
            }
        }
    </script>
@endsection