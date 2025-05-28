<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoModel extends Model
{
    use HasFactory;

    protected $table = 'contacto';

    protected $primaryKey = 'id';

    public $timestamps = true; // Asegura que los timestamps estén habilitados

    protected $fillable = [
        'id_cliente',
        'nombre',
        'correo_electronico',
        'asunto',
        'comentarios',
    ];
}
