<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='vehiculo'; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];
    protected $fillable=[
        'veh_placa',
        'veh_num_chasis',
        'veh_marca',
        'veh_clase',
        'veh_categoria',
        'veh_longitud',
        'veh_ancho',
        'veh_altura',
        'veh_num_eje',
        'veh_num_motor',
        'veh_num_asientp',
        'veh_color',
        'veh_propietario',
        'veh_combustible',
        'veh_modelo',
        'veh_carroceria',
        'veh_VIN',
        'veh_peso_bruto',
        'veh_peso_neto',
        'veh_carga_util',
        'veh_anio_fabricacion',
        'veh_num_llanta',
        'veh_num_pasajero',
        'veh_estado',
        'empresa_id',
        'tenencia_id'
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

    //TODO:RELACIONES
    public function vehiculos():HasMany{
        return $this->hasMany(Tenencia::class,'id');
    }

    public function documentaciones():BelongsTo{
        return $this->belongsTo(Documentacion::class,'id');
    }

    public function bajas_vehiculares():BelongsTo{
        return $this->belongsTo(Baja_Vehicular::class,'id');
    }
}
