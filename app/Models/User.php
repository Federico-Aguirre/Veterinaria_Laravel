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

    // funcion para usar usuario en vez de email en el logueo de usuario
    public function getAuthIdentifierName() {
        return 'usuario';
    }

    // Los campos que son asignables en masa
    protected $fillable = [
        'name',
        'apellido',
        'direccion',
        'piso',
        'departamento',
        'localidad',
        'telefono',
        'celular',
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