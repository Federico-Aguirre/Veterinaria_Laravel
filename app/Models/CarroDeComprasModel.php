<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarroDeComprasModel extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'carro_de_compras';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // Laravel por defecto usa created_at y updated_at, pero si la tabla no las tiene, se debe deshabilitar:
    public $timestamps = false;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'id_cliente',
        'producto_id',
        'producto_categoria',
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
    ];     

    // Relación con el usuario (si tienes un modelo `User`)
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    // Relación con el producto (si tienes un modelo `ProductoModel`)
    public function producto()
    {
        return $this->belongsTo(ProductoModel::class, 'producto_id');
    }
}
