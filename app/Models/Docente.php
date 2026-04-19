<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cargo',
        'bio',
        'foto',
        'linkedin',
        'orden',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'orden' => 'integer',
    ];

    public function scopeVisible($query)
    {
        return $query->where('visible', true)->orderBy('orden')->orderBy('nombre');
    }
}
