<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Representante_Legal;
use App\Models\Tipo_Identificacion;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class RepresentanteLegalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $representante=Representante_Legal::getInstance();
            $lista=$representante->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code'=>200,
                    'success'=>true,
                    'message'=>'LISTA DE REPRESENTANTE LEGAL',
                    'data'=>$lista
                ]);
            }
            return response()->json([
                'code'=>400,
                'success'=>false,
                'message'=>'LISTA SE ENCUENTRA VACIA',
                'data'=>null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'=>400,
                'success'=>false,
                'message'=>$th->getMessage(),
                'data'=>null
            ]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            $representante=Representante_Legal::getInstance();
            $tipo_identificacion=Tipo_Identificacion::getInstance();

            $empresa_encontrada=Empresa::find($request->empresa_id);
            if($empresa_encontrada==null){
                return response()->json([
                    'code'=>400,
                    'success'=>false,
                    'message'=>'LA EMPRESA NO EXISTE',
                    'data'=>null
                ]);
            }
            $representante->empresa_id=$request->empresa_id;
            $representante->rle_nombres=$request->rle_nombres;
            $representante->rle_correo=$request->rle_correo;
            $representante->rle_domicilio=$request->rle_domicilio;
            $representante->rle_telefono=$request->rle_telefono;
            $representante->rle_cargo=$request->rle_cargo;
            $representante->rle_num_RRPP=$request->rle_num_RRPP;
            $representante->rle_fec_inicio=now();
            $representante->rle_fec_fin=now();
            $representante->rle_observacion=$request->rle_observacion;

            $indentificacion_encontrada=$tipo_identificacion->find($request->tipo_identificacion_id);
            if($indentificacion_encontrada==null){
                return response()->json([
                    'code'=>400,
                    'success'=>false,
                    'message'=>'Identificacion no existe',
                    'data'=>null
                ]);
            }
            $representante->tipo_identificacion_id=$request->tipo_identificacion_id;
            $representante->save();
            return response()->json([
                'code'=>200,
                'success'=>true,
                'message'=>'OPERACION EXITOSA',
                'data'=>$representante
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'=>400,
                'success'=>false,
                'message'=>$th->getMessage(),
                'data'=>null
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $representante=Representante_Legal::getInstance();
            $representante_encontrado=$representante->find($id);
            if($representante_encontrado!=null){
                $representante_encontrado->rle_estado=0;
                $representante_encontrado->update();
                return response()->json([
                    'code'=>200,
                    'success'=>true,
                    'message'=>'OPERACION EXITOSA',
                    'data'=>$representante_encontrado
                ]);
            }
            
            return response()->json([
                'code'=>400,
                'success'=>false,
                'message'=>'NO EXISTE ID DE REPRESENTANTE',
                'data'=>null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'=>400,
                'success'=>false,
                'message'=>$th->getMessage(),
                'data'=>null
            ]);
        }
    }
}
