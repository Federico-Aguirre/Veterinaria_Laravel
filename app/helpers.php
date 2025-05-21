<?php

if (! function_exists('vite')) {
    /**
     * Helper para obtener la URL de los archivos generados por Vite.
     *
     * @param  string  $asset
     * @return string
     */
    function vite($asset)
    {
        // Verifica que el archivo manifest.json exista y pueda ser leído
        $manifestPath = public_path('build/.vite/manifest.json');
        
        if (!file_exists($manifestPath)) {
            throw new Exception('No se encuentra el archivo manifest.json de Vite.');
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        // Si no se encuentra el archivo, retorna el asset original
        if (isset($manifest[$asset])) {
            return asset('build/' . $manifest[$asset]['file']);
        }

        return asset($asset);  // Si no encuentra el asset en el manifest, retorna la ruta original
    }
}
