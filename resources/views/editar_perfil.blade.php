@extends('layouts.app')

@if(session('edición_de_usuario_exitoso'))
    <script>
        alert("{{ session('edición_de_usuario_exitoso') }}");
    </script>
@endif

@section('content')
    <section class="editarPerfil formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera active"><a href="#editar-perfil">Editar Perfil</a></li>
                <li class="tab tab-segunda"><a href="javascript:void(0);" id="ver-perfil-btn">Ver Perfil</a></li>
                <li class="tab tab-tercera"><a id="borrarPerfilButton" class="borrar_perfil_btn">Borrar Perfil</a></li>
            </ul>

            <div class="contenido-tab">
                <div id="editar-perfil" style="display: block;">
                    <form action="{{ route('actualizar_perfil') }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Uso PUT para actualizar los datos -->

                        <h1 style="padding:10px 0">Editar perfil</h1>

                        <div class="contenedor-input">
                            <label>Nombre</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Apellido</label>
                                <input type="text" name="Apellido" value="{{ Auth::user()->Apellido }}" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Dirección</label>
                                <input type="text" name="Dirección" value="{{ Auth::user()->Dirección }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Piso</label>
                                <input type="number" name="Piso" value="{{ Auth::user()->Piso }}" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Departamento</label>
                                <input type="text" name="Departamento" value="{{ Auth::user()->Departamento }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Localidad</label>
                            <input type="text" name="Localidad" value="{{ Auth::user()->Localidad }}" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Teléfono</label>
                            <input type="text" name="Teléfono" value="{{ Auth::user()->Teléfono }}" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Celular</label>
                            <input type="text" name="Celular" value="{{ Auth::user()->Celular }}" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Email</label>    
                            <input type="text" name="Email" value="{{ Auth::user()->email }}" required>
                        </div>
                        <input type="submit" class="button button-block" value="Editar perfil">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection