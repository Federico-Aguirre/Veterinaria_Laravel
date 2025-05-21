<h2>Nuevo Mensaje de Contacto</h2>

<p><strong>Nombre:</strong> {{ $contacto->Nombre }}</p>
<p><strong>Correo Electrónico:</strong> {{ $contacto->Correo_electronico }}</p>
<p><strong>Asunto:</strong> {{ $contacto->Asunto ?? 'Sin asunto' }}</p>
<p><strong>Comentarios:</strong></p>
<p>{{ $contacto->Comentarios }}</p>

<hr>
<small>Este es un mensaje automático.</small>