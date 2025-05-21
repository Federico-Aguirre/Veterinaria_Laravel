<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ComprasRealizadasModel extends Model
{
    protected $table = 'compras_realizadas';

    protected $fillable = [
        'id_cliente',
        'producto_id',
        'producto_cantidad',
        'producto_imagen',
        'producto_descripcion',
        'producto_precio',
        'producto_stock',
        'producto_caracteristicas_1',
        'producto_caracteristicas_2',
        'producto_caracteristicas_3',
        'producto_caracteristicas_4',
        'producto_caracteristicas_5',
        'producto_precio_total',
        'fecha_de_compra',
    ];

    public $timestamps = false;

    protected $dates = ['fecha_de_compra'];

}
