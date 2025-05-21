<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnoModel extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    protected $primaryKey = 'id';

    protected $fillable = ['Id_user', 'Fecha', 'Id_mascota', 'Asunto', 'Mensaje'];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'Id_user');
    }
}