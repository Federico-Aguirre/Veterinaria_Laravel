@extends('layouts.app')

@if(session('login_exitoso'))
    <script>
        alert("{{ session('login_exitoso') }}");
    </script>
@endif

@section('content')
    <section class="main seccion flex flex-col items-center">
        <section class="main__heroe flex flex-col justify-center items-center font-semibold">
            <img src="{{ asset('imagenes/main__imagenPrincipal.jpg') }}" alt="imagen principal" class="main__heroe__imagenPrincipal h-[200px] w-[300px] mt-[20px]">
            <div class="main__heroe__texto my-5 w-[490px] text-green">Nuestro equipo de expertos veterinarios y personal dedicado está aquí para ofrecerte un viaje único en el mundo del cuidado animal. Desde los exóticos reptiles hasta los pequeños roedores, estamos preparados para abrazar la diversidad de todas las criaturas que llaman hogar a tu corazón.</div>
            <a href="{{ route('agregar_turno') }}" class="main__heroe__solicitarTurno mb-[20px]">Solicitar Turno</a>
            <a href="{{ route('ver_productos') }}" class="main__heroe__verProductos">Ver Productos</a>
        </section>

        <div class="linea"></div>

        <section class="main__servicios flex flex-col justify-center items-center text-green">
            <div class="main__servicios__titulo font-semibold mb-[20px]">Nuestros Servicios</div>
            <div class="main__servicios__contenedor flex flex-row">
                <img src="{{ asset('imagenes/main__servicios__imagen1.jpg') }}" alt="imagen de animal 1" class="main__servicios__contenedor__imagenIzquierda">
                <div class="main__servicios__contenedor__listaDeServicios w-[400px] flex flex-wrap gap-[20px]">
                    <div class="main__servicios__contenedor__listaDeServicios__servicio1">
                        <img src="{{ asset('imagenes/iconos/veterinario.png') }}" alt="">
                        <div>Revisiones Generales</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio2">
                        <img src="{{ asset('imagenes/iconos/microscopio.png') }}" alt="">
                        <div>Control de Parásitos</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio3">
                        <img src="{{ asset('imagenes/iconos/corazon.png') }}" alt="">
                        <div>Estudios Cardiológicos</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio4">
                        <img src="{{ asset('imagenes/iconos/vacunacion.png') }}" alt="">
                        <div>Vacunaciones</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio5">
                        <img src="{{ asset('imagenes/iconos/comidaDeMascota.png') }}" alt="">
                        <div>Alimentos Balanceados</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio6">
                        <img src="{{ asset('imagenes/iconos/rayos-x.png') }}" alt="">
                        <div>Radiografías y ecografías</div>
                    </div>
                </div>
                <img src="{{ asset('imagenes/main__servicios__imagen2.jpg') }}" alt="imagen de animal 2" class="main__servicios__contenedor__imagenDerecha">
            </div>
        </section>

        <div class="linea"></div>

        <section class="main__direccion flex flex-col justify-center items-center">
            <div class="main__direccion__titulo mb-[20px] text-green">Dirección, Horario y Teléfono</div>
            <div class="main__direccion__ubicacion">
                <img src="{{ asset('imagenes/iconos/ubicacion.png') }}" alt="icono de ubicacion">
                <div>Av. Independencia 1920</div>
            </div>
            <img src="{{ asset('imagenes/mapa.jpg') }}" alt="mapa" class="main__direccion__mapa mb-[20px]">
            <div class="main__direccion__horario">
                <img src="{{ asset('imagenes/iconos/calendario.png') }}" alt="imagen calendario">
                <div>Lunes a Sábado de 7:00AM a 22:00PM</div>
            </div>
            <div class="main__direccion__telefono">
                <img src="{{ asset('imagenes/iconos/telefono.png') }}" alt="imagen telefono">
                <div>(011) 4400 2839</div>
            </div>
            <div class="main__direccion__whatsapp mb-0">
                <img src="{{ asset('imagenes/iconos/whatsapp.png') }}" alt="icono whatsapp">
                <div>11 3678 7918</div>
            </div>
        </section>

        <div class="linea"></div>

        <section class="main__mediosDePago flex flex-col justify-center items-center font-semibold">
            <div class="main__mediosDePago__titulo mb-[20px] text-green">Medios de Pagos</div>
            <div class="main__mediosDePago__tarjetasContenedor flex flex-row flex-wrap justify-center">
                <div>
                    <img src="{{ asset('imagenes/tarjetas de credito/visa.svg') }}" alt="tarjeta 1">
                    <div>Visa</div>
                </div>
                <div>
                    <img src="{{ asset('imagenes/tarjetas de credito/mastercard.svg') }}" alt="tarjeta 2">
                    <div>Master Card</div>
                </div>
                <div>
                    <img src="{{ asset('imagenes/tarjetas de credito/mercado-pago.svg') }}" alt="tarjeta 3">
                    <div>Mercado Pago</div>
                </div>
                <div>
                    <img src="{{ asset('imagenes/tarjetas de credito/american-express.svg') }}" alt="tarjeta 4">
                    <div>American Express</div>
                </div>
            </div>
        </section>

        <div class="linea"></div>
    </section>
@endsection
