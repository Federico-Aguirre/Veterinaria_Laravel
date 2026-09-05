@props([
    'src',
    'alt' => '',
    'class' => ''
])

@php
    // Obtener la ruta sin la extensión original (ej. 'img/productos/perro1.png' -> 'img/productos/perro1')
    $info = pathinfo($src);
    $dirname = isset($info['dirname']) && $info['dirname'] !== '.' ? $info['dirname'] . '/' : '';
    $filename = $info['filename'];

    $avif = $dirname . $filename . '.avif';
    $webp = $dirname . $filename . '.webp';
@endphp

<picture>
    {{-- 1. Intenta cargar AVIF (máxima compresión y calidad) --}}
    <source srcset="{{ asset($avif) }}" type="image/avif">
    
    {{-- 2. Si el navegador no soporta AVIF, intenta cargar WebP --}}
    <source srcset="{{ asset($webp) }}" type="image/webp">
    
    {{-- 3. Respaldo para navegadores antiguos (JPG/PNG) --}}
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="{{ $class }}" {{ $attributes }}>
</picture>