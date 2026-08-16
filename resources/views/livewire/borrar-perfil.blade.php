<button 
    type="button"
    class="borrar_perfil_btn"
    aria-label="Borrar perfil de usuario de forma permanente"
    wire:loading.attr="disabled"
    wire:target="borrarPerfil"
    @click="
        if (confirm('¿Estás seguro de que deseas borrar tu perfil? Esta acción no se puede deshacer.')) {
            $wire.borrarPerfil().then(() => {
                alert('Perfil borrado exitosamente.');
            });
        }
    "
>
    <span wire:loading.remove wire:target="borrarPerfil">Borrar Perfil</span>
    <span wire:loading wire:target="borrarPerfil">Borrando...</span>
</button>