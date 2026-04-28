<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
    ];

    // Relación con el modelo Venta
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }
}
