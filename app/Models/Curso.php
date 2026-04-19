<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'titulo', 'slug', 'descripcion',
        'objetivos', 'dirigido_a', 'duracion', 'modalidad',
        'imagen', 'video_url', 'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
