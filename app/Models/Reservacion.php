<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservacion extends Model
{
    protected $table = 'reservaciones';

    protected $fillable = ['user_id', 'paquete_id', 'personas', 'estado'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paquete(): BelongsTo
    {
        return $this->belongsTo(Paquete::class);
    }
}