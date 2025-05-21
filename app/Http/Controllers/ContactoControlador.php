<?php
namespace App\Http\Controllers;

use App\Models\ContactoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoControlador extends Controller
{
    public function enviar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Asunto' => 'nullable|string|max:255',
            'Comentarios' => 'required|string',
        ]);

        // Guardar en la base de datos
        $contacto = new ContactoModel();
        $contacto->Id_cliente = Auth::id() ?? null; // Usando Auth::id() para obtener el ID del usuario autenticado
        $contacto->Nombre = $request->Nombre;
        $contacto->Correo_electronico = $request->Email;
        $contacto->Asunto = $request->Asunto;
        $contacto->Comentarios = $request->Comentarios;
        $contacto->save(); // Guarda el contacto y asigna el id automáticamente

        // Acceder al id del contacto
        $id = $contacto->id;  // ID asignado automáticamente
        $id = $contacto->id; 

        // Enviar correo
        Mail::send('emails.emailPlantilla', ['contacto' => $contacto], function ($message) use ($request) {
            $message->to('fede.dev3@gmail.com')
                ->subject('Nuevo Mensaje de Contacto')
                ->replyTo($request->Email);
        });

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}