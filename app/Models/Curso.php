<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'slug', 'tipo', 'descripcion',
        'objetivos', 'dirigido_a', 'duracion', 'modalidad',
        'imagen', 'video_url', 'visible',
        'fecha_inicio', 'fecha_fin',
        'precios', 'agenda', 'docentes_curso', 'certificacion',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'precios' => 'array',
        'agenda' => 'array',
        'docentes_curso' => 'array',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
