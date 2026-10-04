<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent de la tabla "iphones".
 * Representa un equipo del catálogo (modelo, capacidad, color, precio y stock).
 */
class Iphone extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
        'almacenamiento',
        'color',
        'color_hex',
        'descripcion',
        'nuevo',
        'precio',
        'stock',
        'imagen',
    ];

    protected $casts = [
        'nuevo'  => 'boolean',
        'precio' => 'decimal:2',
        'stock'  => 'integer',
    ];
}
