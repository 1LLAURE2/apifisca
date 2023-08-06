<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo_Servicio extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='tipo_servicio'; // ? Debo definir la tabla de acorde a la migracion
    protected $hidden = ['created_at','updated_at'];
    protected $fillable=[
        'tse_descripcion',
        'tse_estado'
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

    public function _tipo_de_servicio_empresas():BelongsTo{
        return $this->belongsTo(Empresa::class,"id");
    }
}
