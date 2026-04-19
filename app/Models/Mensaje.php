<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'nombre', 'email', 'telefono', 'mensaje', 'leido',
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];
}
