<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'slug', 'autor',
        'imagen', 'cuerpo', 'publicado_en',
    ];

    protected $casts = [
        'publicado_en' => 'datetime',
    ];
}
