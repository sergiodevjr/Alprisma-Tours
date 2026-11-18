<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paquete extends Model
{
    protected $fillable = ['destino_id', 'titulo', 'precio', 'cupos', 'fecha_salida'];
    
    protected $casts = [
        'fecha_salida' => 'date',
    ];

    public function destino(): BelongsTo
    {
        return $this->belongsTo(Destino::class);
    }

    public function reservaciones(): HasMany
    {
        return $this->hasMany(Reservacion::class);
    }
}
