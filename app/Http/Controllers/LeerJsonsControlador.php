<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

class LeerJsonsControlador extends Controller
{
    public function leerJsons()
    {
        // Ruta a la carpeta de JSONs
        $path = storage_path('app/json');
        
        // Obtener todos los archivos JSON de la carpeta
        $files = File::files($path);
        
        $jsonData = [];

        foreach ($files as $file) {
            if ($file->getExtension() == 'json') {
                // Leer el contenido del archivo y convertirlo a un array asociativo
                $jsonContent = json_decode(File::get($file), true);
                
                // Agregar los datos del JSON a un array
                $jsonData[] = $jsonContent;
            }
        }
        // Retornar los datos para ver en la vista o hacer algo más con ellos
        return response()->json($jsonData);
    }
}
