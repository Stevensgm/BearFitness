<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'cliente_id',
        'total',
        'descuento',
        'estado',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación con el modelo DetalleVenta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

    
}
