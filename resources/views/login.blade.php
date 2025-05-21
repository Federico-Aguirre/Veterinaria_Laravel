@extends('layouts.app')

@if(session('registro_de_usuario_exitoso'))
    <script>
        alert("{{ session('registro_de_usuario_exitoso') }}");
    </script>
@endif

@if(session('login_error'))
    <script>
        alert("{{ session('login_error') }}");
    </script>
@endif

@if(session('cambio_de_contraseña_exitoso'))
    <script>
        alert("{{ session('cambio_de_contraseña_exitoso') }}");
    </script>
@endif

@section('content')
    <section class="login">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs flex justify-end space-x-4 mb-10">
                <li class="tab tab-primera active"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li class="tab tab-segunda"><a href="{{ route('registrarse') }}" id="registrarse">Registrarse</a></li>
            </ul>
            <div class="contenido-tab">
                <div id="iniciar-sesion">
                    <h1>Iniciar Sesión</h1>
                    <!-- Formulario de inicio de sesión -->
                    <form id="loginForm" action="{{ route('procesarLogin') }}" method="POST">
                        @csrf
                        <div class="contenedor-input">
                            <input type="text" name="usuario" placeholder="Usuario" required>
                        </div>
                        <div class="contenedor-input">
                            <input type="password" name="password" placeholder="Contraseña" required>
                        </div>
                        <p class="forgot"><a href="{{ route('recuperar_clave') }}">Se te olvidó la contraseña?</a></p>
                        <input type="submit" class="button button-block" value="Iniciar Sesión">
                    </form>
                    <div class="login__icon-container">
                        <a href="{{ route('auth.google') }}" class="btn btn-danger login__icon-container__icon-link"><img src="{{ asset('imagenes/iconos/google_icon.svg') }}" alt="google icon"></a>
                        <a href="{{ route('auth.facebook') }}" class="btn btn-primary login__icon-container__icon-link"><img src="{{ asset('imagenes/iconos/facebook_icon.svg') }}" alt="facebook icon"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection