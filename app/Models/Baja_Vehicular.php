<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Baja_Vehicular extends Model
{
    use HasFactory;

    /**
     * TODO: PATRON SINGLETON
     */
    private static $instance;
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //TODO: RELACIONES

    public function motivo_de_bajas():HasMany{
        return $this->hasMany(Motivo_Baja::class,'id');
    }

    public function tipo_de_documentos():HasMany{
        return $this->hasMany(Tipo_Documento::class,'id');
    }

    public function vehiculos():HasMany{
        return $this->hasMany(Vehiculo::class,'id');
    }
}
