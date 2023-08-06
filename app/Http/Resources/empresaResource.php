<?php

namespace App\Http\Resources;

use App\Models\Autorizacion;
use App\Models\Empresa;
use App\Models\Representante_Legal;
use App\Models\Servicio;
use Illuminate\Http\Resources\Json\JsonResource;
use League\CommonMark\Extension\CommonMark\Node\Block\ListData;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use Nette\Utils\ArrayList;

class empresaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // return parent::toArray($request);

        return [
            'id'=>$this->id,
            'emp_partida_registral'=>$this->emp_partida_registral,
            'emp_RUC'=>$this->emp_RUC,
            'emp_razon_social'=>$this->emp_razon_social,
            'emp_abreviatura'=>$this->emp_abreviatura,
            'emp_num_inscripcion_SUNARP'=>$this->emp_num_inscripcion_SUNARP,
            'emp_lug_inscripcion_SUNARP'=>$this->emp_lug_inscripcion_SUNARP,
            'emp_num_mz_km'=>$this->emp_num_mz_km,
            'emp_telefono'=>$this->emp_telefono,
            'emp_email'=>$this->emp_email,
            'emp_partida_electronica_SUNARP'=>$this->emp_partida_electronica_SUNARP,
            'emp_fec_inscripcion_SUNARP'=>$this->emp_fec_inscripcion_SUNARP,
            'emp_nombre_via'=>$this->emp_nombre_via,
            'emp_lote_int'=>$this->emp_lote_int,
            'emp_nom_urba'=>$this->emp_nom_urba,
            'emp_URL'=>$this->emp_URL,
            'emp_referencia'=>$this->emp_referencia,
            'emp_estado'=>$this->emp_estado,
            'servicio'=>servicioResocurce::collection($this->whenLoaded('servicios')),
            'tipo_servicio'=>tipoServicioResocurce::collection($this->whenLoaded('tipo_servicios')),

            'representante'=>Representante_Legal::where('empresa_id',$this->id)->where('rle_estado',1)->get(),
            'autorizacion'=>Autorizacion::where('empresa_id',$this->id)->where('aut_estado',1)->get()

        ];
    
    }
    //* FUNCIONA: Representante_Legal::where('empresa_id',$this->id)->where('rle_estado',1)->get()
    //collect(Autorizacion::where('empresa_id',$this->id)->where('aut_estado',1))
    //Representante_Legal::where('empresa_id',$this->id)
    //Representante_Legal::where('rle_estado',1)->orWhere('id','=',$this->id)->get()
    //Representante_Legal::find($this->id)->where($request->representantes()->rle_estado,'==',1)
    //->where('rle_estado','==',1)
    //Representante_Legal::find($this->id)
    //Producto::orderBy("descripcion")->where("id_establecimiento", "=", Auth::user()->establecimiento->id);
    //Servicio::all()
    //servicioResocurce::collection($this->whenLoaded('servicios'))
}
