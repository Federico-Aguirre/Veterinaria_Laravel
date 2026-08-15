<div x-data @contacto-enviado.window="alert($event.detail.message)">
    <section class="contacto flex justify-center items-center px-4 py-[30px]">
        <div class="contacto__formulario my-[20vh] mb-[50px] h-auto rounded-[5px] bg-colorFormulario bg-center bg-no-repeat bg-cover p-[30px]">
            <h1 class="text-white font-light mb-[40px] text-[24px] text-center">Envíe su contacto</h1>

            <form wire:submit.prevent="enviar" class="flex flex-col w-full">
                <label for="Nombre">Nombre</label>
                <input type="text" wire:model.defer="Nombre" required style="color: black;">

                <label for="Email">Correo electrónico</label>
                <input type="email" wire:model.defer="Email" required style="color: black;">

                <label for="Asunto">Asunto</label>
                <input type="text" wire:model.defer="Asunto" style="color: black;">

                <label for="Comentarios">Comentarios</label>
                <textarea wire:model.defer="Comentarios" cols="50" rows="5" required style="color: black;"></textarea>

                @error('Nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('Email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('Comentarios') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <button type="submit"
                    class="contacto__formulario__boton bg-green text-white hover:bg-skyBlue hover:cursor-pointer mt-4">
                    Enviar
                </button>
            </form>
        </div>
    </section>
</div>