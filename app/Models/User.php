<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  // Cambiar de Model a Authenticatable
{
    use HasFactory, Notifiable;

    // Definir la tabla que estás utilizando
    protected $table = 'users';

    protected $primaryKey = 'id';

    // Los campos que son asignables en masa
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

    // Laravel gestiona automáticamente los timestamps (created_at, updated_at)
    public $timestamps = true;

    // Para asegurarnos de que las contraseñas se cifren correctamente
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = bcrypt($user->password);
            }
        });
    }
}