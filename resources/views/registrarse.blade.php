@extends('layouts.app')

@if(session('registro_de_usuario_error'))
    <script>
        alert("{{ session('registro_de_usuario_error') }}");
    </script>
@endif

@section('content')
    <section class="registrarse formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs">
                <li class="tab tab-primera"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li class="tab tab-segunda active"><a href="{{ route('registrarse') }}">Registrarse</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="registrarse">
                    <h1>Registrarse</h1>

                    <!-- Formulario de registro -->
                    <form id="registerForm" action="{{ route('procesarRegistro') }}" method="POST">
                        @csrf
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Nombre/s<span class="req">*</span></label>
                                <input type="text" name="name" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Apellido/s<span class="req">*</span></label>
                                <input type="text" name="surname" required>
                            </div>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>DNI<span class="req">*</span></label>
                                <input type="text" name="dni" required>
                            </div>    
                            <div class="contenedor-input">
                                <label>CUIL/CUIT<span class="req"></span></label>
                                <input type="text" name="cuil_cuit">
                            </div>  
                        </div>                    
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Dirección<span class="req">*</span></label>
                                <input type="text" name="address" required>
                            </div>    
                            <div class="contenedor-input">
                                <label>Piso<span class="req"></span></label>
                                <input type="number" name="floor">
                            </div>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Departamento<span class="req"></span></label>
                                <input type="text" name="department">
                            </div>    
                            <div class="contenedor-input">
                                <label>Localidad<span class="req">*</span></label>
                                <input type="text" name="locality" required>
                            </div>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Teléfono Particular<span class="req"></span></label>
                                <input type="text" name="phone">
                            </div>
                            <div class="contenedor-input">
                                <label>Teléfono Celular<span class="req">*</span></label>
                                <input type="text" name="cellphone" required>
                            </div>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Correo Electrónico<span class="req">*</span></label>
                            <input type="email" name="email" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Usuario<span class="req">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Contraseña<span class="req">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <br>

                        <br>
                        <input type="submit" class="button button-block" value="Registrarse">
                    </form>

                </div>
                <div id="iniciar-sesion">
                </div>
            </div>
        </div>
    </section>
@endsection