<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrearUsuarioModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Apellido',
        'DNI',
        'CUIL_CUIT',
        'Dirección',
        'Piso',
        'Departamento',
        'Localidad',
        'Teléfono',
        'Celular',
        'email',
        'Usuario',
        'password',
    ];

    protected $table = 'users';

    // Laravel gestiona automáticamente los timestamps (created_at, updated_at)
    public $timestamps = true;  // Esto es para asegurarnos que Laravel maneje estos campos automáticamente
}
