@extends('layouts.app')

@if(session('mensaje_enviado_correctamente'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert("{{ session('mensaje_enviado_correctamente') }}");
        });
    </script>
@endif

@section('content')
<section class="contacto flex justify-center items-center px-4 py-[30px]" aria-label="Formulario de contacto">
    <div class="contacto__formulario my-[20vh] mb-[50px] h-auto rounded-[5px] bg-colorFormulario bg-center bg-no-repeat bg-cover p-[30px]">
        <h1 class="text-white font-light mb-[40px] text-[24px] text-center">Envíe su contacto</h1>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    alert("{{ session('success') }}");
                });
            </script>
        @endif

        <form class="flex flex-col w-full" action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="ddbc571d-06d8-4b1e-a588-5cc004de6e72">

            <label for="Nombre">Nombre</label>
            <input type="text" id="Nombre" name="Nombre" autocomplete="name" required style="color: black;">

            <label for="Email">Correo electrónico</label>
            <input type="email" id="Email" name="Email" autocomplete="email" required style="color: black;">

            <label for="_subject">Asunto</label>
            {{-- 💡 Usar name="_subject" hace que FormSubmit use este texto como asunto del email recibido --}}
            <input type="text" id="_subject" name="_subject" style="color: black;">

            <label for="Comentarios">Comentarios</label>
            <textarea id="Comentarios" name="Comentarios" cols="50" rows="5" required style="color: black;"></textarea>

            <input class="contacto__formulario__boton bg-green text-white hover:bg-skyBlue hover:cursor-pointer" type="submit" value="Enviar">
        </form>
    </div>
</section>
@endsection