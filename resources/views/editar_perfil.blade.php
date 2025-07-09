@extends('layouts.app')

@if(session('edición_de_usuario_exitoso'))
    <script>
        alert("{{ session('edición_de_usuario_exitoso') }}");
    </script>
@endif

@if (session('complete_datos_de_perfil'))
    <div>
        {{ session('complete_datos_de_perfil') }}
    </div>
@endif

@section('content')
    <section class="editarPerfil formulario">
        <div class="contenedor-formularios">
            <ul class="contenedor-tabs" style="margin:0">
                <li class="tab tab-primera active"><a href="#editar-perfil">Editar Perfil</a></li>
                <li class="tab tab-segunda"><a href="javascript:void(0);" id="ver_perfil_btn">Ver Perfil</a></li>
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
                                <input type="text" name="Apellido" value="{{ Auth::user()->apellido }}" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Dirección</label>
                                <input type="text" name="Direccion" value="{{ Auth::user()->direccion }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="fila-arriba">
                            <div class="contenedor-input">
                                <label>Piso</label>
                                <input type="number" name="Piso" value="{{ Auth::user()->piso }}" required>
                            </div>
                            <div class="contenedor-input">
                                <label>Departamento</label>
                                <input type="text" name="Departamento" value="{{ Auth::user()->departamento }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Localidad</label>
                            <input type="text" name="Localidad" value="{{ Auth::user()->localidad }}" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Teléfono</label>
                            <input type="text" name="Teléfono" value="{{ Auth::user()->telefono }}" required>
                        </div>
                        <br>
                        <div class="contenedor-input">
                            <label>Celular</label>
                            <input type="text" name="Celular" value="{{ Auth::user()->celular }}" required>
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
    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('ver_perfil_btn');
            if (!btn) return;
            if (!btn.dataset.listenerAdded) {
                btn.addEventListener('click', function () {
                    fetch('/ver-perfil')
                        .then(response => response.json())
                        .then(data => {
                            let mensaje = `
                                Nombre: ${data.name}
                                Apellido: ${data.apellido}
                                Dirección: ${data.direccion}
                                Piso: ${data.piso}
                                Departamento: ${data.departamento}
                                Localidad: ${data.localidad}
                                Teléfono: ${data.telefono}
                                Celular: ${data.celular}
                                Email: ${data.email}
                            `;
                            alert(mensaje);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al obtener el perfil');
                        });
                });
                btn.dataset.listenerAdded = 'true';
            }
        });
    </script>

@endsection