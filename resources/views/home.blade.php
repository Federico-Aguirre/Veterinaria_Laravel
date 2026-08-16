@extends('layouts.app')

@section('content')
    <div x-data="{ alertMsg: '{{ session('success') ?? session('login_exitoso') ?? session('alert') ?? '' }}' }"
         x-init="if (alertMsg) { alert(alertMsg); }">
    </div>

    <section class="main seccion flex flex-col items-center">
        <section class="main__heroe flex flex-col justify-center items-center font-semibold">
            {{-- Imagen LCP (Hero): Carga prioritaria explícita sin lazy loading --}}
            <x-picture 
                src="imagenes/main__imagenPrincipal.jpg" 
                alt="Atención médica veterinaria para todo tipo de mascotas" 
                class="main__heroe__imagenPrincipal h-[200px] w-[300px] mt-[20px]" 
                loading="eager"
                fetchpriority="high"
                decoding="async"
            />
            <div class="main__heroe__texto my-5 w-[490px] text-green">Nuestro equipo de expertos veterinarios y personal dedicado está aquí para ofrecerte un viaje único en el mundo del cuidado animal. Desde los exóticos reptiles hasta los pequeños roedores, estamos preparados para abrazar la diversidad de todas las criaturas que llaman hogar a tu corazón.</div>
            <a href="{{ route('agregar_turno_formulario') }}" class="main__heroe__solicitarTurno mb-[20px]">Solicitar Turno</a>
            <a href="{{ route('ver_productos') }}" class="main__heroe__verProductos">Ver Productos</a>
        </section>

        <div class="linea"></div>

        <section class="main__servicios flex flex-col justify-center items-center text-green">
            <h2 class="main__servicios__titulo font-semibold mb-[20px]">Nuestros Servicios</h2>
            <div class="main__servicios__contenedor flex flex-row">
                <x-picture src="imagenes/main__servicios__imagen1.jpg" alt="Mascota en consulta veterinaria" class="main__servicios__contenedor__imagenIzquierda" loading="lazy" decoding="async" />
                <div class="main__servicios__contenedor__listaDeServicios w-[400px] flex flex-wrap gap-[20px]">
                    <div class="main__servicios__contenedor__listaDeServicios__servicio1">
                        <x-picture src="imagenes/iconos/veterinario.png" alt="Icono revisiones generales" loading="lazy" decoding="async" />
                        <div>Revisiones Generales</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio2">
                        <x-picture src="imagenes/iconos/microscopio.png" alt="Icono control de parásitos" loading="lazy" decoding="async" />
                        <div>Control de Parásitos</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio3">
                        <x-picture src="imagenes/iconos/corazon.png" alt="Icono estudios cardiológicos" loading="lazy" decoding="async" />
                        <div>Estudios Cardiológicos</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio4">
                        <x-picture src="imagenes/iconos/vacunacion.png" alt="Icono vacunaciones" loading="lazy" decoding="async" />
                        <div>Vacunaciones</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio5">
                        <x-picture src="imagenes/iconos/comidaDeMascota.png" alt="Icono alimentos balanceados" loading="lazy" decoding="async" />
                        <div>Alimentos Balanceados</div>
                    </div>
                    <div class="main__servicios__contenedor__listaDeServicios__servicio6">
                        <x-picture src="imagenes/iconos/rayos-x.png" alt="Icono radiografías y ecografías" loading="lazy" decoding="async" />
                        <div>Radiografías y ecografías</div>
                    </div>
                </div>
                <x-picture src="imagenes/main__servicios__imagen2.jpg" alt="Mascota recibiendo atención médica" class="main__servicios__contenedor__imagenDerecha" loading="lazy" decoding="async" />
            </div>
        </section>

        <div class="linea"></div>

        <section class="main__direccion flex flex-col justify-center items-center">
            <h2 class="main__direccion__titulo mb-[20px] text-green">Dirección, Horario y Teléfono</h2>
            <div class="main__direccion__ubicacion">
                <x-picture src="imagenes/iconos/ubicacion.png" alt="Icono de ubicación" loading="lazy" decoding="async" />
                <div>Av. Independencia 1920</div>
            </div>
            <x-picture src="imagenes/mapa.jpg" alt="Mapa de ubicación de la clínica" class="main__direccion__mapa mb-[20px]" loading="lazy" decoding="async" />
            <div class="main__direccion__horario">
                <x-picture src="imagenes/iconos/calendario.png" alt="Icono de horario" loading="lazy" decoding="async" />
                <div>Lunes a Sábado de 7:00AM a 22:00PM</div>
            </div>
            <div class="main__direccion__telefono">
                <x-picture src="imagenes/iconos/telefono.png" alt="Icono de teléfono" loading="lazy" decoding="async" />
                <div>(011) 4400 2839</div>
            </div>
            <div class="main__direccion__whatsapp mb-0">
                <x-picture src="imagenes/iconos/whatsapp.png" alt="Icono de WhatsApp" loading="lazy" decoding="async" />
                <div>11 3678 7918</div>
            </div>
        </section>

        <div class="linea"></div>

        <section class="main__mediosDePago flex flex-col justify-center items-center font-semibold">
            <h2 class="main__mediosDePago__titulo mb-[20px] text-green">Medios de Pagos</h2>
            <div class="main__mediosDePago__tarjetasContenedor flex flex-row flex-wrap justify-center">
                <div>
                    <x-picture src="imagenes/tarjetas de credito/visa.svg" alt="Logotipo Visa" loading="lazy" decoding="async" />
                    <div>Visa</div>
                </div>
                <div>
                    <x-picture src="imagenes/tarjetas de credito/mastercard.svg" alt="Logotipo Mastercard" loading="lazy" decoding="async" />
                    <div>Master Card</div>
                </div>
                <div>
                    <x-picture src="imagenes/tarjetas de credito/mercado-pago.svg" alt="Logotipo Mercado Pago" loading="lazy" decoding="async" />
                    <div>Mercado Pago</div>
                </div>
                <div>
                    <x-picture src="imagenes/tarjetas de credito/american-express.svg" alt="Logotipo American Express" loading="lazy" decoding="async" />
                    <div>American Express</div>
                </div>
            </div>
        </section>

        <div class="linea"></div>
    </section>
@endsection