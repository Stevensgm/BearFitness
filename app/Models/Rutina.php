<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rutina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'dia',
        'nivel',
        'duracion_minutos',
        'grupo_muscular',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
