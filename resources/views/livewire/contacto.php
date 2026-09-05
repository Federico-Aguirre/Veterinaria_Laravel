<div x-data @contacto-enviado.window="alert($event.detail.message)">
    <section class="contacto flex justify-center items-center px-4 py-[30px]">
        <div class="contacto__formulario my-[20vh] mb-[50px] h-auto rounded-[5px] bg-colorFormulario bg-center bg-no-repeat bg-cover p-[30px]">
            <h1 class="text-white font-light mb-[40px] text-[24px] text-center">Envíe su contacto</h1>

            <form wire:submit.prevent="enviar" class="flex flex-col w-full" aria-label="Formulario de contacto" novalidate>
                
                {{-- Nombre --}}
                <label for="Nombre">Nombre <span aria-hidden="true" class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="Nombre" 
                    wire:model.defer="Nombre" 
                    required 
                    autocomplete="name"
                    aria-required="true" 
                    style="color: black;"
                    @error('Nombre') aria-invalid="true" aria-describedby="error-Nombre" @enderror
                >

                {{-- Email --}}
                <label for="Email">Correo electrónico <span aria-hidden="true" class="text-red-500">*</span></label>
                <input 
                    type="email" 
                    id="Email" 
                    wire:model.defer="Email" 
                    required 
                    autocomplete="email"
                    aria-required="true" 
                    style="color: black;"
                    @error('Email') aria-invalid="true" aria-describedby="error-Email" @enderror
                >

                {{-- Asunto --}}
                <label for="Asunto">Asunto</label>
                <input 
                    type="text" 
                    id="Asunto" 
                    wire:model.defer="Asunto" 
                    style="color: black;"
                    @error('Asunto') aria-invalid="true" aria-describedby="error-Asunto" @enderror
                >

                {{-- Comentarios --}}
                <label for="Comentarios">Comentarios <span aria-hidden="true" class="text-red-500">*</span></label>
                <textarea 
                    id="Comentarios" 
                    wire:model.defer="Comentarios" 
                    cols="50" 
                    rows="5" 
                    required 
                    aria-required="true" 
                    style="color: black;"
                    @error('Comentarios') aria-invalid="true" aria-describedby="error-Comentarios" @enderror
                ></textarea>

                {{-- Errores: Se mantienen en el orden original, pero se les agregó un ID para ser leídos por ARIA --}}
                @error('Nombre') <span id="error-Nombre" class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</span> @enderror
                @error('Email') <span id="error-Email" class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</span> @enderror
                @error('Comentarios') <span id="error-Comentarios" class="text-red-500 text-sm mt-1" role="alert">{{ $message }}</span> @enderror

                {{-- Botón de envío con prevención de clics múltiples --}}
                <button 
                    type="submit"
                    class="contacto__formulario__boton bg-green text-white hover:bg-skyBlue hover:cursor-pointer mt-4"
                    wire:loading.attr="disabled"
                    wire:target="enviar"
                >
                    <span wire:loading.remove wire:target="enviar">Enviar</span>
                    <span wire:loading wire:target="enviar">Enviando...</span>
                </button>
            </form>
        </div>
    </section>
</div>