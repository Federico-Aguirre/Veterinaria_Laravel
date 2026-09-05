<div x-data x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    <section class="registrarse formulario">
        <div class="contenedor-formularios">
            <nav aria-label="Navegación de acceso">
                <ul class="contenedor-tabs" role="tablist">
                    <li class="tab tab-primera" role="presentation">
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="tab tab-segunda active" role="presentation">
                        <a href="{{ route('registrarse') }}" aria-current="page">Registrarse</a>
                    </li>
                </ul>
            </nav>

            <div class="contenido-tab">
                <div id="registrarse">
                    <h1>Registrarse</h1>

                    <form wire:submit.prevent="agregar" aria-label="Formulario de registro de usuario" novalidate>
                        
                        {{-- Nombre y Apellido --}}
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label for="name">Nombre/s <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    wire:model.defer="name" 
                                    autocomplete="given-name" 
                                    required 
                                    aria-required="true"
                                    @error('name') aria-invalid="true" aria-describedby="error-name" @enderror
                                >
                                @error('name') <div class="error" id="error-name" role="alert">{{ $message }}</div> @enderror
                            </div>

                            <div class="contenedor-input">
                                <label for="surname">Apellido/s <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="text" 
                                    id="surname" 
                                    wire:model.defer="surname" 
                                    autocomplete="family-name" 
                                    required 
                                    aria-required="true"
                                    @error('surname') aria-invalid="true" aria-describedby="error-surname" @enderror
                                >
                                @error('surname') <div class="error" id="error-surname" role="alert">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <br>

                        {{-- DNI y CUIL/CUIT --}}
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label for="dni">DNI <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="text" 
                                    id="dni" 
                                    wire:model.defer="dni" 
                                    required 
                                    aria-required="true"
                                    @error('dni') aria-invalid="true" aria-describedby="error-dni" @enderror
                                >
                                @error('dni') <div class="error" id="error-dni" role="alert">{{ $message }}</div> @enderror
                            </div>    
                            <div class="contenedor-input">
                                <label for="cuil_cuit">CUIL/CUIT</label>
                                <input 
                                    type="text" 
                                    id="cuil_cuit" 
                                    wire:model.defer="cuil_cuit"
                                    @error('cuil_cuit') aria-invalid="true" aria-describedby="error-cuil_cuit" @enderror
                                >
                                @error('cuil_cuit') <div class="error" id="error-cuil_cuit" role="alert">{{ $message }}</div> @enderror
                            </div>  
                        </div>   

                        <br>

                        {{-- Dirección y Piso --}}
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label for="address">Dirección <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="text" 
                                    id="address" 
                                    wire:model.defer="address" 
                                    autocomplete="street-address" 
                                    required 
                                    aria-required="true"
                                    @error('address') aria-invalid="true" aria-describedby="error-address" @enderror
                                >
                                @error('address') <div class="error" id="error-address" role="alert">{{ $message }}</div> @enderror
                            </div>    
                            <div class="contenedor-input">
                                <label for="floor">Piso</label>
                                <input 
                                    type="number" 
                                    id="floor" 
                                    wire:model.defer="floor"
                                    @error('floor') aria-invalid="true" aria-describedby="error-floor" @enderror
                                >
                                @error('floor') <div class="error" id="error-floor" role="alert">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <br>

                        {{-- Departamento y Localidad --}}
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label for="department">Departamento</label>
                                <input 
                                    type="text" 
                                    id="department" 
                                    wire:model.defer="department"
                                    @error('department') aria-invalid="true" aria-describedby="error-department" @enderror
                                >
                                @error('department') <div class="error" id="error-department" role="alert">{{ $message }}</div> @enderror
                            </div>    
                            <div class="contenedor-input">
                                <label for="locality">Localidad <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="text" 
                                    id="locality" 
                                    wire:model.defer="locality" 
                                    autocomplete="address-level2" 
                                    required 
                                    aria-required="true"
                                    @error('locality') aria-invalid="true" aria-describedby="error-locality" @enderror
                                >
                                @error('locality') <div class="error" id="error-locality" role="alert">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <br>

                        {{-- Teléfonos --}}
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label for="phone">Teléfono Particular</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    wire:model.defer="phone" 
                                    autocomplete="tel"
                                    @error('phone') aria-invalid="true" aria-describedby="error-phone" @enderror
                                >
                                @error('phone') <div class="error" id="error-phone" role="alert">{{ $message }}</div> @enderror
                            </div>
                            <div class="contenedor-input">
                                <label for="cellphone">Teléfono Celular <span class="req" aria-hidden="true">*</span></label>
                                <input 
                                    type="tel" 
                                    id="cellphone" 
                                    wire:model.defer="cellphone" 
                                    autocomplete="tel" 
                                    required 
                                    aria-required="true"
                                    @error('cellphone') aria-invalid="true" aria-describedby="error-cellphone" @enderror
                                >
                                @error('cellphone') <div class="error" id="error-cellphone" role="alert">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <br>

                        {{-- Email --}}
                        <div class="contenedor-input">
                            <label for="email">Correo Electrónico <span class="req" aria-hidden="true">*</span></label>
                            <input 
                                type="email" 
                                id="email" 
                                wire:model.defer="email" 
                                autocomplete="email" 
                                required 
                                aria-required="true"
                                @error('email') aria-invalid="true" aria-describedby="error-email" @enderror
                            >
                            @error('email') <div class="error" id="error-email" role="alert">{{ $message }}</div> @enderror
                        </div>

                        <br>

                        {{-- Usuario --}}
                        <div class="contenedor-input">
                            <label for="username">Usuario <span class="req" aria-hidden="true">*</span></label>
                            <input 
                                type="text" 
                                id="username" 
                                wire:model.defer="username" 
                                autocomplete="username" 
                                required 
                                aria-required="true"
                                @error('username') aria-invalid="true" aria-describedby="error-username" @enderror
                            >
                            @error('username') <div class="error" id="error-username" role="alert">{{ $message }}</div> @enderror
                        </div>

                        <br>

                        {{-- Contraseña --}}
                        <div class="contenedor-input">
                            <label for="password">Contraseña <span class="req" aria-hidden="true">*</span></label>
                            <input 
                                type="password" 
                                id="password" 
                                wire:model.defer="password" 
                                autocomplete="new-password" 
                                required 
                                aria-required="true"
                                @error('password') aria-invalid="true" aria-describedby="error-password" @enderror
                            >
                            @error('password') <div class="error" id="error-password" role="alert">{{ $message }}</div> @enderror
                        </div>

                        <br>

                        {{-- Botón de envío --}}
                        <button 
                            type="submit" 
                            class="button button-block"
                            wire:loading.attr="disabled"
                            wire:target="agregar"
                        >
                            <span wire:loading.remove wire:target="agregar">Registrarse</span>
                            <span wire:loading wire:target="agregar">Procesando registro...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>