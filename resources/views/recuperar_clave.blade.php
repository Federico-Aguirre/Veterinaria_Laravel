@extends('layouts.app')

@if(session('recuperación_de_clave_exitoso'))
    <script>
        alert("{{ session('recuperación_de_clave_exitoso') }}");
    </script>
@endif

@section('content')
    <section class="recuperar-clave formulario">
        <div class="contenedor-formularios">
            <div class="contenido-tab">
                <h1>Recuperar Contraseña</h1>

                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                @if(session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif

                <form action="{{ route('recuperar_clave.enviar') }}" method="POST">
                    @csrf
                    <div class="contenedor-input">
                        <label for="email">Correo electrónico</label>
                        <input type="email" name="email" required style="color: black;">
                    </div>

                    <input class="recuperar-clave__formulario__boton" type="submit" value="Enviar enlace de recuperación">
                </form>
            </div>
        </div>
    </section>
@endsection