@extends('layouts.app')

@section('content')
    <section class="recuperar-clave formulario">
        <div class="recuperar-clave__formulario contenedor-formularios">
            <div class="contenido-tab">
                <h1>Restablecer Contraseña</h1>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Hidden input for the email and token -->
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ request()->get('email') }}">

                    <div class="contenedor-input">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="contenedor-input">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" required>
                    </div>

                    <div class="contenedor-input">
                        <button type="submit">Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
