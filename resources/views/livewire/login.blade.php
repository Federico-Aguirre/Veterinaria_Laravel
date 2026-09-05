<div x-data
     x-init="@if(session('alert')) alert('{{ session('alert') }}'); @endif"
     x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    <section class="formulario">
        <div class="contenedor-formularios">
            
            {{-- Se envuelve en un <nav> accesible para estructurar correctamente las pestañas --}}
            <nav aria-label="Navegación de acceso">
                <ul class="contenedor-tabs" role="tablist">
                    <li class="tab tab-primera active" role="presentation">
                        <a href="{{ route('login') }}" aria-current="page">Iniciar Sesión</a>
                    </li>
                    <li class="tab tab-segunda" role="presentation">
                        <a href="{{ route('registrarse') }}">Registrarse</a>
                    </li>
                </ul>
            </nav>

            <div class="contenido-tab">
                <div id="iniciar-sesion">
                    <h1>Iniciar Sesión</h1>

                    <form wire:submit.prevent="login" aria-label="Formulario de inicio de sesión">
                        
                        {{-- Se agregan aria-labels para evitar romper el diseño por falta de etiqueta <label> --}}
                        <div class="contenedor-input">
                            <input 
                                type="text" 
                                id="usuario"
                                wire:model.defer="usuario" 
                                placeholder="Usuario" 
                                aria-label="Usuario"
                                required 
                                aria-required="true"
                                autocomplete="username"
                            >
                        </div>

                        <div class="contenedor-input">
                            <input 
                                type="password" 
                                id="password"
                                wire:model.defer="password" 
                                placeholder="Contraseña" 
                                aria-label="Contraseña"
                                required 
                                aria-required="true"
                                autocomplete="current-password"
                            >
                        </div>

                        <p class="forgot">
                            {{-- Se añade el signo de interrogación de apertura por ortografía --}}
                            <a href="{{ route('recuperar_clave') }}">¿Se te olvidó la contraseña?</a>
                        </p>

                        {{-- Indicador de carga para prevenir múltiples envíos --}}
                        <button 
                            type="submit" 
                            class="button button-block"
                            wire:loading.attr="disabled"
                            wire:target="login"
                        >
                            <span wire:loading.remove wire:target="login">Iniciar Sesión</span>
                            <span wire:loading wire:target="login">Iniciando sesión...</span>
                        </button>
                    </form>

                    <div class="login__icon-container">
                        {{-- Se traslada la descripción auditiva al enlace (acción) en lugar de la imagen --}}
                        <a href="{{ url('/login/google') }}" class="btn btn-danger login__icon-container__icon-link" aria-label="Iniciar sesión con Google">
                            <x-picture src="{{ asset('imagenes/iconos/google_icon.svg') }}" alt="" aria-hidden="true" />
                        </a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-primary login__icon-container__icon-link" aria-label="Iniciar sesión con Facebook">
                            <x-picture src="{{ asset('imagenes/iconos/facebook_icon.svg') }}" alt="" aria-hidden="true" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>