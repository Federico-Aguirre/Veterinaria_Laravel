<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/tailwind/main.scss')
    @vite('resources/js/app.js')
    @livewireStyles
    <title>Veterinaria</title>
</head>
<body class="font-custom bg-gray overflow-x-hidden overflow-y-scroll">

<!-- Header -->
<header class="header h-[10vh] w-full font-semibold text-green fixed top-0 z-[100] bg-white flex items-center px-4">
    <nav x-data="{ menuHamburguesaOpen: false }" class="w-full max-w-6xl flex items-center justify-between mx-auto">

        <!-- Logo -->
        <div class="flex items-center">
            <img src="{{ asset('imagenes/logo.png') }}" alt="logo" class="h-10">
        </div>

        <!-- Links centrados -->
        <ul class="hidden md:flex flex-1 justify-center items-center gap-6">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li class="hidden lg:block"><a href="{{ route('acercaDeNosotros') }}">Acerca de Nosotros</a></li>
            <li class="hidden lg:block"><a href="{{ route('contacto') }}">Contacto</a></li>

            @auth
                <li>
                    <form action="{{ route('logOut') }}" method="POST">
                        @csrf 
                        <button type="submit">Log Out</button>
                    </form>
                </li>
                <li class="hidden md:flex items-center gap-2">
                    <img src="{{ asset('imagenes/iconos/usuario.svg') }}" class="h-6"/>
                    <div>{{ Auth::user()->name }}</div>
                </li>

                <!-- Componente Livewire Carrito -->
                <livewire:carrito />

            @else
                <li><a href="{{ route('login') }}">Log In</a></li>
            @endauth
        </ul>

        <!-- Botón hamburguesa siempre visible -->
        <button @click="menuHamburguesaOpen = !menuHamburguesaOpen" 
                class="header__navBar flex flex-col justify-center w-14 h-10 transition-transform duration-100 hover:scale-110">
            <span :class="{'rotate-45 translate-y-[5px] translate-x-2': menuHamburguesaOpen}" 
                  class="block h-1 w-full bg-green transition-all -ml-2 mb-[5px]"></span>
            <span :class="{'-rotate-45 -translate-y-1': menuHamburguesaOpen}" 
                  class="block h-1 w-full bg-green transition-all"></span>
        </button>

        <!-- Menú lateral hamburguesa -->
        <div x-cloak x-show="menuHamburguesaOpen" @click.away="menuHamburguesaOpen = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="fixed top-[10vh] right-0 h-[90vh] bg-white shadow-lg flex flex-col gap-2 p-4 z-50"
        >
            <a href="{{ route('home') }}" class="w-full">Inicio</a>
            <a href="{{ route('acercaDeNosotros') }}" class="w-full">Acerca de Nosotros</a>
            <a href="{{ route('contacto') }}" class="w-full">Contacto</a>

            @auth
                <a href="{{ route('editar_perfil') }}" class="w-full">Editar perfil</a>
                <a href="{{ route('agregar_mascota_formulario') }}" class="w-full">Editar mascota</a>
                <a href="{{ route('agregar_turno_formulario') }}" class="w-full">Editar Turno</a>
                <a href="{{ route('compras.realizadas') }}" class="w-full">Compras realizadas</a>
                <a href="{{ route('ver_productos') }}" class="w-full">Ver Productos</a>
            @else
                <a href="{{ route('login') }}" class="w-full">Log In</a>
                <a href="{{ route('agregar_turno_formulario') }}" class="w-full">Solicitar Turno</a>
                <a href="{{ route('ver_productos') }}" class="w-full">Ver Productos</a>
            @endauth
        </div>
    </nav>
</header>

{{-- Menú desplegable responsive extra si lo necesitás --}}
<div x-cloak class="navBarMenu" x-data="{ open: false }" x-show="open" x-transition>
    <a href="{{ route('home') }}" class="navBarMenu__home">Inicio</a>
    <a href="{{ route('acercaDeNosotros') }}" class="navBarMenu__projects">Acerca de Nosotros</a>
    <a href="{{ route('contacto') }}" class="navBarMenu__contacto">Contacto</a>

    @auth
        <a href="{{ route('editar_perfil') }}">Editar perfil</a>
        <a href="{{ route('agregar_mascota_formulario') }}" class="navBarMenu__formularioMascota">Editar mascota</a>
        <a href="{{ route('agregar_turno_formulario') }}" class="navBarMenu__turnos">Editar Turno</a>
        <a href="{{ route('compras.realizadas') }}" class="navBarMenu__formularioMascota">Compras realizadas</a>
        <a href="{{ route('ver_productos') }}" class="navBarMenu__stock">Ver Productos</a>
    @else
        <a href="{{ route('login') }}" class="navBarMenu__login">Log In</a>
        <a href="{{ route('agregar_turno_formulario') }}" class="navBarMenu__turnos">Solicitar Turno</a>
        <a href="{{ route('ver_productos') }}" class="navBarMenu__stock">Ver Productos</a>
    @endauth
</div>

{{-- Botón de WhatsApp --}}
<a href="https://api.whatsapp.com/send?phone=+5491155912380&text=Hola! Quisiera más información!" target="_blank">
    <img src="{{ asset('imagenes/iconos/whatsapp2.png') }}" 
        class="globalWhatsapp transition-all duration-[250ms] ease-in h-[80px] w-[80px] fixed right-[50px] bottom-[50px] hover:scale-[1.2]
        sm:right-[60px] sm:bottom-[60px] lg:right-[70px] lg:bottom-[70px]"/>
</a>

{{-- Contenido principal --}}
@yield('content') 

<footer class="flex flex-row place-content-center gap-y-0 gap-x-5 pb-[30px]">
    <div>Términos de uso</div>
    <div>© 1996-1997 +cota</div>
    <div>Políticas de privacidad</div>
</footer>

@yield('scripts')

{{-- Livewire Scripts --}}
@livewireScripts

<script>
document.addEventListener('livewire:load', function () {
    // Listener para alertas globales
    Livewire.on('alerta', data => {
        alert(data.mensaje);
    });

    // Listener para confirmaciones con acción
    Livewire.on('confirmacion', data => {
        if (confirm(data.mensaje)) {
            Livewire.dispatch(data.accionConfirmada);
        }
    });
});
</script>

</body>
</html>
