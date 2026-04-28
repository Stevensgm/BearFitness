<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

}
