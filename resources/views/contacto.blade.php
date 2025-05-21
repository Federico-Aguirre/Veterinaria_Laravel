@extends('layouts.app')

@if(session('mensaje_enviado_correctamente'))
  <script>
    alert("{{ session('mensaje_enviado_correctamente') }}");
  </script>
@endif

@section('content')
  <section class="contacto flex justify-center items-center px-4 py-[30px]">
    <div class="contacto__formulario my-[20vh] mb-[50px] h-auto rounded-[5px] bg-colorFormulario bg-center bg-no-repeat bg-cover p-[30px]">
      <h1 class="text-white font-light mb-[40px] text-[24px] text-center">Envíe su contacto</h1>

      @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
      @endif

      <form class="flex flex-col w-full" action="https://formsubmit.co/fede.dev3@gmail.com" method="POST">
        @csrf
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" required style="color: black;">

        <label for="Email">Correo electrónico</label>
        <input type="email" name="Email" required style="color: black;">

        <label for="Asunto">Asunto</label>
        <input type="text" name="Asunto" style="color: black;">

        <label for="Comentarios">Comentarios</label>
        <textarea name="Comentarios" cols="50" rows="5" required style="color: black;"></textarea>

        <input class="contacto__formulario__boton bg-green text-white hover:bg-skyBlue hover:cursor-pointer" type="submit" value="Enviar">
      </form>
    </div>
  </section>
@endsection
