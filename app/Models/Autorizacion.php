<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autorizacion extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='autorizacion'; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];
    protected $fillable=[
        'aut_marco_legal',
        'aut_num_expediente',
        'aut_num_resolucion',
        'aut_fec_expediente',
        'aut_fec_resolucion',
        'aut_anio_vigencia',
        'aut_objeto_social',
        'aut_observacion',
        'aut_estado',
        'empresa_id'
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

    //TODO: RELACIONES
    public function empresas():HasMany{
        return $this->hasMany(Empresa::class,'id');
    }

}
