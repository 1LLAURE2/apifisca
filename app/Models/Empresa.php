<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='empresa'; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];
    protected $fillable=[
            "emp_partida_registral",
            "emp_RUC",
            "emp_razon_social",
            "emp_abreviatura",
            "emp_num_inscripcion_SUNARP",
            "emp_lug_inscripcion_SUNARP",
            "emp_num_mz_km",
            "emp_telefono",
            "emp_email",
            "emp_partida_electronica_SUNARP",
            "emp_fec_inscripcion_SUNARP",
            "emp_nombre_via",
            "emp_lote_int",
            "emp_nom_urba",
            "emp_URL",
            "emp_referencia",
            "emp_estado",
            "tipo_servicio_id",
            "servicio_id"
    ];

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

    public function tipo_servicios():HasMany{//_empresa_tipo_servicios
        return $this->hasMany(Tipo_Servicio::class,"id");
    }

    public function servicios():HasMany{//_empresa_servicios
        return $this->hasMany(Servicio::class,"id");
    }

    public function representantes():BelongsTo{//_empresa_representantes_legales
        return $this->belongsTo(Representante_Legal::class,"id");
    }

    public function autorizaciones():BelongsTo{
        return $this->belongsTo(Autorizacion::class,'id');
    }

}
