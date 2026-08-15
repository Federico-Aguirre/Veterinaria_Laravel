<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ConvertirImagenes extends Command
{
    protected $signature = 'imagenes:convertir';
    protected $description = 'Escanea la carpeta public/ y convierte todas las imágenes JPG/PNG a WebP y AVIF';

    public function handle()
    {
        $directorioPublic = public_path();

        if (!File::exists($directorioPublic)) {
            $this->error("No se encontró la carpeta public.");
            return;
        }

        $this->info("Escaneando imágenes en todo public/: {$directorioPublic}");

        $archivos = File::allFiles($directorioPublic);
        $convertidosWebp = 0;
        $convertidosAvif = 0;

        $soportaWebp = function_exists('imagewebp');
        $soportaAvif = function_exists('imageavif');

        if (!$soportaWebp) {
            $this->error("Tu versión de PHP GD no soporta WebP.");
        }
        if (!$soportaAvif) {
            $this->warn("Tu PHP GD no tiene soporte nativo para AVIF. Se generarán imágenes en formato WebP.");
        }

        foreach ($archivos as $archivo) {
            $ext = strtolower($archivo->getExtension());

            // Procesar solo JPG, JPEG y PNG
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                continue;
            }

            $pathReal = $archivo->getRealPath();
            $pathInfo = pathinfo($pathReal);
            $rutaBase = $pathInfo['dirname'] . '/' . $pathInfo['filename'];

            // Cargar imagen en memoria
            $img = null;
            if (in_array($ext, ['jpg', 'jpeg'])) {
                $img = @imagecreatefromjpeg($pathReal);
            } elseif ($ext === 'png') {
                $img = @imagecreatefrompng($pathReal);
                if ($img) {
                    imagepalettetotruecolor($img);
                    imagealphablending($img, true);
                    imagesavealpha($img, true);
                }
            }

            if (!$img) {
                continue;
            }

            // 1. Guardar versión WebP
            $pathWebp = $rutaBase . '.webp';
            if (!File::exists($pathWebp) && $soportaWebp) {
                if (@imagewebp($img, $pathWebp, 80)) {
                    $this->info("✓ WebP: " . $archivo->getRelativePathname() . " -> " . pathinfo($pathWebp, PATHINFO_BASENAME));
                    $convertidosWebp++;
                }
            }

            // 2. Guardar versión AVIF
            $pathAvif = $rutaBase . '.avif';
            if (!File::exists($pathAvif) && $soportaAvif) {
                if (@imageavif($img, $pathAvif, 70)) {
                    $this->info("✓ AVIF: " . $archivo->getRelativePathname() . " -> " . pathinfo($pathAvif, PATHINFO_BASENAME));
                    $convertidosAvif++;
                }
            }

            imagedestroy($img);
        }

        $this->info("--------------------------------------------------");
        $this->info("¡Proceso finalizado!");
        $this->info("Imágenes convertidas a WebP: {$convertidosWebp}");
        $this->info("Imágenes convertidas a AVIF: {$convertidosAvif}");
    }
}