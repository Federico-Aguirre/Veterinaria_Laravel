<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnoModel extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    protected $primaryKey = 'id';

    protected $fillable = ['id_user', 'fecha', 'id_mascota', 'mascota_nombre', 'asunto', 'mensaje'];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}