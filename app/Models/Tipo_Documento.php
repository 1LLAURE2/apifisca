<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipo_Documento extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='tipo_documento'; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];

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

    public function baja_vehiculares():BelongsTo{
        return $this->belongsTo(Baja_Vehicular::class,'id');
    }
}
