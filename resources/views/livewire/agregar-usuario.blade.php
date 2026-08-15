<div x-data
     x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    <section class="registrarse formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs">
                <li class="tab tab-primera"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li class="tab tab-segunda active"><a href="{{ route('registrarse') }}">Registrarse</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="registrarse">
                    <h1>Registrarse</h1>

                    <form wire:submit.prevent="agregar">
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Nombre/s<span class="req">*</span></label>
                                <input type="text" wire:model.defer="name" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Apellido/s<span class="req">*</span></label>
                                <input type="text" wire:model.defer="surname" required>
                            </div>
                        </div>

                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>DNI<span class="req">*</span></label>
                                <input type="text" wire:model.defer="dni" required>
                            </div>    
                            <div class="contenedor-input">
                                <label>CUIL/CUIT</label>
                                <input type="text" wire:model.defer="cuil_cuit">
                            </div>  
                        </div>   

                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Dirección<span class="req">*</span></label>
                                <input type="text" wire:model.defer="address" required>
                            </div>    
                            <div class="contenedor-input">
                                <label>Piso</label>
                                <input type="number" wire:model.defer="floor">
                            </div>
                        </div>

                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Departamento</label>
                                <input type="text" wire:model.defer="department">
                            </div>    
                            <div class="contenedor-input">
                                <label>Localidad<span class="req">*</span></label>
                                <input type="text" wire:model.defer="locality" required>
                            </div>
                        </div>

                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Teléfono Particular</label>
                                <input type="text" wire:model.defer="phone">
                            </div>
                            <div class="contenedor-input">
                                <label>Teléfono Celular<span class="req">*</span></label>
                                <input type="text" wire:model.defer="cellphone" required>
                            </div>
                        </div>

                        <br>
                        <div class="contenedor-input">
                            <label>Correo Electrónico<span class="req">*</span></label>
                            <input type="email" wire:model.defer="email" required>
                        </div>

                        <br>
                        <div class="contenedor-input">
                            <label>Usuario<span class="req">*</span></label>
                            <input type="text" wire:model.defer="username" required>
                        </div>

                        <br>
                        <div class="contenedor-input">
                            <label>Contraseña<span class="req">*</span></label>
                            <input type="password" wire:model.defer="password" required>
                        </div>

                        <br>
                        <button type="submit" class="button button-block">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
