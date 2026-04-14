<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'precio_venta',
        'stock',
        'categoria',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'precio' => 'decimal:2',
        'precio_venta' => 'decimal:2',
    ];
}
