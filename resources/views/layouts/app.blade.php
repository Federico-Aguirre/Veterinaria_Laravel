@php
    $ocultarCarro = ($cantidadDeProductosEnCarro ?? 0) === 0;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/tailwind/main.scss')

    @vite('resources/js/app.js')
    <title>Veterinaria</title>
</head>
<body class="font-custom bg-gray overflow-x-hidden overflow-y-scroll">
    <header class="header h-[10vh] w-full text-[1.3em] font-semibold text-green fixed top-0 z-[100] bg-white flex items-center justify-center max-[799px]:h-[100px]">
        @if (Auth::check() && session('cantidadDeProductosEnCarro') == 0) <!-- Verifica si el usuario está autenticado y no hay productos en carro -->
            <nav>
                <ul>
                    <li class="header__logoContenedor"><img src="{{ asset('imagenes/logo.png') }}" alt="logo" class="header__logoContenedor__logo"></li>
                    <li class="header__inicio"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="header__acercaDeNosotros"><a href="{{ route('acercaDeNosotros') }}">Acerca de Nosotros</a></li>
                    <li class="header__contacto"><a href="{{ route('contacto') }}" class="header__contacto__button">Contacto</a></li>
                    <li class="header__login">
                        <form action="{{ route('logOut') }}" method="POST">
                            @csrf <!-- Token CSRF para protección -->
                            <button type="submit" class="header__logOut__button">Log Out</button>
                        </form>
                    </li>
                    <button class="header__navBar" title="navBarMenu">
                        <div class="header__navBar__line"></div>
                        <div class="header__navBar__line"></div>
                    </button>
                    <a href="{{ route('editar_perfil') }}">
                        <li class="header__perfil"><img src="{{ asset('imagenes/iconos/usuario.svg') }}" class="header__iconoUsuario"/><div>{{ session('sessionUsuario') }}</div></li>
                    </a>
                </ul>
            </nav>
        @endif
        @if (Auth::check() && session()->has('cantidadDeProductosEnCarro') && session('cantidadDeProductosEnCarro') > 0)
            <nav>
                <ul>
                    <li class="header__logoContenedor"><img src="{{ asset('imagenes/logo.png') }}" alt="logo" class="header__logoContenedor__logo"></li>
                    <li class="header__inicio"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="header__acercaDeNosotros"><a href="{{ route('acercaDeNosotros') }}">Acerca de Nosotros</a></li>
                    <li class="header__contacto"><a href="{{ route('contacto') }}" class="header__contacto__button">Contacto</a></li>
                    <li class="header__login">
                        <form action="{{ route('logOut') }}" method="POST">
                            @csrf <!-- Token CSRF para protección -->
                            <button type="submit" class="header__logOut__button">Log Out</button>
                        </form>
                    </li>
                    <button class="header__navBar" title="navBarMenu">
                        <div class="header__navBar__line"></div>
                        <div class="header__navBar__line"></div>
                    </button>
                    <li class="header__perfil"><img src="{{ asset('imagenes/iconos/usuario.svg') }}" class="header__iconoUsuario"/><div>{{ session('sessionUsuario') }}</div></li>
                    <li class="header__carroDeCompra">
                        @if (!$ocultarCarro)
                            <a href="{{ route('carro_de_compras') }}" class="carro-container flex items-center gap-2">
                                <img src="{{ asset('imagenes/iconos/shopping-cart.svg') }}" class="header__carroDeCompra__button" />
                                <span id="contador-carrito" class="header__carroDeCompra__cantidad p-0 m-0">
                                    {{ $cantidadDeProductosEnCarro }}
                                </span>
                            </a>
                        @endif
                    </li>
                </ul>
            </nav>
        @endif
        @if (!Auth::check())
            <nav>
                <ul>
                    <li class="header__logoContenedor"><img src="{{ asset('imagenes/logo.png') }}" alt="logo" class="header__logoContenedor__logo"></li>
                    <li class="header__inicio"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="header__acercaDeNosotros"><a href="{{ route('acercaDeNosotros') }}">Acerca de Nosotros</a></li>
                    <li class="header__contacto"><a href="{{ route('contacto') }}" class="header__contacto__button">Contacto</a></li>
                    <li class="header__login"><a href="{{ route('login') }}" class="header__login__button">Log In</a></li> 
                    <button class="header__navBar" title="navBarMenu">
                        <div class="header__navBar__line"></div>
                        <div class="header__navBar__line"></div>
                    </button>
                </ul>
            </nav>
        @endif
    </header>
    <div class="navBarMenu">
    @if (Auth::check()) <!-- Verifica si el usuario está autenticado -->
        <a href="{{ route('home') }}" class="navBarMenu__home">Inicio</a>
        <a href="{{ route('acercaDeNosotros') }}" class="navBarMenu__projects">Acerca de Nosotros</a>
        <a href="{{ route('contacto') }}" class="navBarMenu__contacto">Contacto</a>
        <a href="{{ route('editar_perfil') }}">Editar perfil</a>
        <a href="{{ route('agregar_mascota_formulario') }}" class="navBarMenu__formularioMascota">Editar mascota</a>
        <a href="{{ route('agregar_turno') }}" class="navBarMenu__turnos">Editar Turno</a>
        <a href="{{ route('compras.realizadas') }}" class="navBarMenu__formularioMascota">Compras realizadas</a>
        <a href="{{ route('ver_productos') }}" class="navBarMenu__stock">Ver Productos</a>
    @else
        <a href="{{ route('home') }}" class="navBarMenu__home">Inicio</a>
        <a href="{{ route('acercaDeNosotros') }}" class="navBarMenu__projects">Acerca de Nosotros</a>
        <a href="{{ route('contacto') }}" class="navBarMenu__contacto">Contacto</a>
        <a href="{{ route('login') }}" class="navBarMenu__login">Log In</a>
        <a href="{{ route('agregar_turno') }}" class="navBarMenu__turnos">Solicitar Turno</a>
        <a href="{{ route('ver_productos') }}" class="navBarMenu__stock">Ver Productos</a>
    @endif
</div>
    <a href="https://api.whatsapp.com/send?phone=+5491155912380&text=Hola! Quisiera más información!" target="_blank">
        <img src="{{ asset('imagenes/iconos/whatsapp2.png') }}" 
        class="globalWhatsapp transition-all duration-[250ms] ease-in h-[80px] w-[80px] fixed right-[50px] bottom-[50px] hover:scale-[1.2]
          sm:right-[60px] sm:bottom-[60px] lg:right-[70px] lg:bottom-[70px]"/>
" />
    </a>
    @yield('content') <!-- Aquí se carga el contenido de cada vista -->
    <footer class="flex flex-row place-content-center gap-y-0 gap-x-5 pb-[30px]">
        <div>Términos de uso</div>
        <div>© 1996-1997 +cota</div>
        <div>Políticas de privacidad</div>
    </footer>
    @yield('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verificar si el carrito está vacío en la carga de la página
        fetch('/obtenerCantidadProductosEnCarro')
            .then(res => res.json())
            .then(data => {
                const cantidad = data.cantidad || 0;
                // Si la cantidad es 0, ocultamos el icono y el contenedor del carrito
                const contadorCarrito = document.getElementById('contador-carrito');
                const carroContainer = document.querySelector('.carro-container');
                
                if (cantidad === 0) {
                    contadorCarrito.style.display = 'none';  // Oculta el icono del carrito
                    carroContainer.style.display = 'none';   // Oculta el contenedor del carrito
                } else {
                    // Si hay productos, aseguramos que el carrito esté visible
                    contadorCarrito.textContent = cantidad;
                    contadorCarrito.style.display = 'inline-block';  // Muestra el icono del carrito
                    carroContainer.style.display = 'flex';  // Muestra el contenedor
                }
            })
            .catch(error => {
                console.error('Error al obtener la cantidad del carrito:', error);
            });
        });
    </script>
</body>
</html>
