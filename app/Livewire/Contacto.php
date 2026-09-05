<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Contacto extends Component
{
    public $Nombre;
    public $Email;
    public $Asunto;
    public $Comentarios;

    protected $rules = [
        'Nombre' => 'required|string|max:255',
        'Email' => 'required|email|max:255',
        'Asunto' => 'nullable|string|max:255',
        'Comentarios' => 'required|string',
    ];

    public function enviar()
    {
        $this->validate();

        $contacto = new ContactoModel();
        $contacto->Id_cliente = Auth::id() ?? null;
        $contacto->Nombre = $this->Nombre;
        $contacto->Correo_electronico = $this->Email;
        $contacto->Asunto = $this->Asunto;
        $contacto->Comentarios = $this->Comentarios;
        $contacto->save();

        Mail::send('emails.emailPlantilla', ['contacto' => $contacto], function ($message) {
            $message->to('fede.dev3@gmail.com')
                    ->subject('Nuevo Mensaje de Contacto')
                    ->replyTo($this->Email);
        });

        // limpiar los campos
        $this->reset(['Nombre', 'Email', 'Asunto', 'Comentarios']);

        // mostrar alerta en frontend
        $this->dispatch('contacto-enviado', message: 'Mensaje enviado correctamente.');
    }

    public function render()
    {
        return view('livewire.contacto-form');
    }
}