<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Documentacion extends Model
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

    public function vehiculos():HasMany{
        return $this->hasMany(Vehiculo::class,'id');
    }
}
