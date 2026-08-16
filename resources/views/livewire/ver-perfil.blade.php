<div x-data
     x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    
    {{-- Se agregó href="#", wire:click.prevent y role="button" por accesibilidad --}}
    <a 
        href="#"
        class="ver_perfil_btn" 
        wire:click.prevent="mostrar"
        role="button"
        aria-label="Ver Perfil"
    >
        <span wire:loading.remove wire:target="mostrar">Ver Perfil</span>
        <span wire:loading wire:target="mostrar">Cargando...</span>
    </a>
</div>