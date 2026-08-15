<div x-data
     x-init="@if(session('alert')) alert('{{ session('alert') }}'); @endif"
     x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    <section class="formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs">
                <li class="tab tab-primera active"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li class="tab tab-segunda"><a href="{{ route('registrarse') }}">Registrarse</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="iniciar-sesion">
                    <h1>Iniciar Sesión</h1>

                    <form wire:submit.prevent="login">
                        <div class="contenedor-input">
                            <input type="text" wire:model.defer="usuario" placeholder="Usuario" required>
                        </div>

                        <div class="contenedor-input">
                            <input type="password" wire:model.defer="password" placeholder="Contraseña" required>
                        </div>

                        <p class="forgot">
                            <a href="{{ route('recuperar_clave') }}">Se te olvidó la contraseña?</a>
                        </p>

                        <button type="submit" class="button button-block">Iniciar Sesión</button>
                    </form>

                    <div class="login__icon-container">
                        <a href="{{ url('/login/google') }}" class="btn btn-danger login__icon-container__icon-link">
                            <x-picture src="{{ asset('imagenes/iconos/google_icon.svg') }}" alt="google icon" />
                        </a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-primary login__icon-container__icon-link">
                            <x-picture src="{{ asset('imagenes/iconos/facebook_icon.svg') }}" alt="facebook icon" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>