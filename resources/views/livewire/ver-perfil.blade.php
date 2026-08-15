<div x-data
     x-on:mostrar-alerta.window="window.alert($event.detail.message)">
    <a class="ver_perfil_btn" wire:click="mostrar">
        Ver Perfil
    </a>
</div>
