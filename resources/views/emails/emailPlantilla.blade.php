<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        strong { color: #333; }
        small { color: #888; }
    </style>
</head>
<body>
    <h2>Nuevo Mensaje de Contacto</h2>

    <p><strong>Nombre:</strong> {{ $contacto->Nombre }}</p>
    <p><strong>Correo Electrónico:</strong> {{ $contacto->Correo_electronico }}</p>
    <p><strong>Asunto:</strong> {{ $contacto->Asunto ?? 'Sin asunto' }}</p>
    <p><strong>Comentarios:</strong></p>
    <p>{{ $contacto->Comentarios }}</p>

    <hr>
    <small>Este es un mensaje automático.</small>
</body>
</html>