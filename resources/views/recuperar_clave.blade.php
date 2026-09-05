@extends('layouts.app')

@if(session('recuperación_de_clave_exitoso'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert("{{ session('recuperación_de_clave_exitoso') }}");
        });
    </script>
@endif

@section('content')
<section class="recuperar-clave formulario" aria-labelledby="titulo-recuperar">
    <div class="contenedor-formularios">
        <div class="contenido-tab">
            <h1 id="titulo-recuperar">Recuperar Contraseña</h1>

            @if(session('success'))
                <p style="color: green;" role="status">{{ session('success') }}</p>
            @endif

            @if(session('error'))
                <p style="color: red;" role="alert">{{ session('error') }}</p>
            @endif

            <form action="{{ route('recuperar_clave.enviar') }}" method="POST">
                @csrf
                <div class="contenedor-input">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" autocomplete="email" required style="color: black;">
                </div>

                <input class="recuperar-clave__formulario__boton" type="submit" value="Enviar enlace de recuperación">
            </form>
        </div>
    </div>
</section>
@endsection