<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;  // Agregar esta línea
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  // Cambiar de Model a Authenticatable
{
    use HasFactory, Notifiable;

    // Definir la tabla que estás utilizando
    protected $table = 'users';

    // Los campos que son asignables en masa
    protected $fillable = [
        'name',
        'Apellido',
        'Dirección',
        'Piso',
        'Departamento',
        'Localidad',
        'Teléfono',
        'Celular',
        'email'
    ];

    // Laravel gestiona automáticamente los timestamps (created_at, updated_at)
    public $timestamps = true;

    // Para asegurarnos de que las contraseñas se cifren correctamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Cifrar la contraseña antes de crear el usuario
            $user->password = bcrypt($user->password);
        });
    }
}