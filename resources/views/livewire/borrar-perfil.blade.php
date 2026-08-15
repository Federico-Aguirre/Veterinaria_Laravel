<a type="button"
   class="borrar_perfil_btn"
   @click="
       alert('Perfil borrado exitosamente.');
       $wire.borrarPerfil();
   ">
   Borrar Perfil
</a>