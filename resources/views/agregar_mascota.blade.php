@extends('layouts.app')

@if(session('mascota_creada_exitosamente'))
    <script>
        alert("{{ session('mascota_creada_exitosamente') }}");
    </script>
@endif

@section('content')
    <section class="editarMascota formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera active"><a href="{{ route('agregar_mascota') }}">Agregar Mascota</a></li>
                <li class="tab tab-segunda"><a href="{{ route('editar_mascota_formulario') }}">Editar Mascota</a></li>
                <li class="tab tab-tercera"><a href="{{ route('ver_mascota') }}">Ver Mascota</a></li>
                <li class="tab tab-cuarta"><a href="{{ route('borrar_mascota_formulario') }}">Borrar Mascota</a></li>
            </ul>

            <div class="contenido-tab">
                <br />
                <!-- Formulario de inicio de sesión -->
                <form id="registerForm" action="{{ route('agregar_mascota') }}" method="POST">
                    @csrf
                    <div class="contenedor-input">
                        <label>Nombre de la mascota<span class="req">*</span></label>
                        <input type="text" name="Nombre" value="{{ old('Nombre') }}" required>
                        @error('Nombre') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Raza<span class="req">*</span></label>
                        <input type="text" name="Raza" value="{{ old('Raza') }}" required>
                        @error('Raza') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Sexo<span class="req">*</span></label>
                        <input type="text" name="Sexo" value="{{ old('Sexo') }}" required>
                        @error('Sexo') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Edad<span class="req">*</span></label>
                        <input type="number" name="Edad" value="{{ old('Edad') }}" required>
                        @error('Edad') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Nro. de microchip</label>
                        <input type="text" name="Nro_de_microchip" value="{{ old('Nro_de_microchip') }}">
                        @error('Nro_de_microchip') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Vacuna antirrábica</label>
                        <input type="checkbox" name="Vacuna_antirrábica" value="1">
                        @error('Vacuna_antirrábica') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Tratamiento antiparasitario</label>
                        <input type="checkbox" name="Tratamiento_antiparasitario" value="1">
                        @error('Tratamiento_antiparasitario') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Otras vacunas</label>
                        <input type="text" name="Otras_vacunas" value="{{ old('Otras_vacunas') }}">
                        @error('Otras_vacunas') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="contenedor-input">
                        <label>Información adicional</label>    
                        <input type="text" name="Información_adicional" value="{{ old('Información_adicional') }}">
                        @error('Información_adicional') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <input type="submit" class="button button-block" value="Agregar mascota">
                </form>
            </div>
        </div>
    </section>
@endsection