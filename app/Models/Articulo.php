<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'titulo', 'slug', 'autor',
        'imagen', 'cuerpo', 'publicado_en',
    ];

    protected $casts = [
        'publicado_en' => 'datetime',
    ];
}
