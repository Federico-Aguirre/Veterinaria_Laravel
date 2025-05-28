<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MascotaModel extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'raza', 'sexo', 'edad', 'nro_de_microchip', 'vacuna_antirrábica', 
        'tratamiento_antiparasitario', 'otras_vacunas', 'información_adicional', 'id_user'
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}