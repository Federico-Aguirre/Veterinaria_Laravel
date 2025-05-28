<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrearUsuarioModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'apellido',
        'dni',
        'cuil_cuit',
        'direccion',
        'piso',
        'departamento',
        'localidad',
        'telefono',
        'celular',
        'email',
        'usuario',
        'password',
    ];

    protected $table = 'users';

    // Laravel gestiona automáticamente los timestamps (created_at, updated_at)
    public $timestamps = true;  // Esto es para asegurarnos que Laravel maneje estos campos automáticamente
}
