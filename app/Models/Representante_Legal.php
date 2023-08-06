<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representante_Legal extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table="representante_legal"; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];
    protected $fillable=[
        'rle_nombres',
        'rle_correo',
        'rle_domicilio',
        'rle_telefono',
        'rle_cargo',
        'rle_num_RRPP',
        'rle_fec_inicio',
        'rle_fec_fin',
        'rle_observacion',
        'tipo_identificacion_id',
        'empresa_id',
        'rle_estado'
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

    public function _empresas():HasMany{
        return $this->hasMany(Empresa::class,"id");
    }

    public function _identificaciones():HasMany{
        return $this->hasMany(Tipo_Identificacion::class,'id');
    }
}
