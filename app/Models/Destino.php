<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destino extends Model
{
    protected $fillable = ['nombre', 'pais', 'descripcion'];

    public function paquetes(): HasMany
    {
        return $this->hasMany(Paquete::class);
    }
}
