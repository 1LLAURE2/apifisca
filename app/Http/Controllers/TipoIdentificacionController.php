<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tipo_Identificacion;
use Illuminate\Http\Request;

class TipoIdentificacionController extends Controller
{
    public function index()
    {

        
        try {
            $tipoIdentificacion = Tipo_Identificacion::getInstance(); // * LLAMO AL SINGLETON
            $lista = $tipoIdentificacion->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_IDENTIFICACION_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_IDENTIFICACION_VACIO',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
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
        try {
            $tipoIdentificacion = Tipo_Identificacion::getInstance();
            $tipoIdentificacion->tid_descripcion=$request->tid_descripcion;
            $tipoIdentificacion->tid_estado=$request->tid_estado;
            $tipoIdentificacion->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'Tipo de identificacion se registro correctamente',
                'data' => $tipoIdentificacion
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
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
        try {
            $tipoIdentificacion = Tipo_Identificacion::getInstance();
            $datoEncontrado=$tipoIdentificacion->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Tipo de identificacion encontrado',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'El Tipo de identificacion no se encontro',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'success' => true,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
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
        try {
            $tipoIdentificacion = Tipo_Identificacion::getInstance();
            $datoEncontrado=$tipoIdentificacion->find($id);
            if($datoEncontrado!=null){
                $tipoIdentificacion->tid_descripcion=$request->tid_descripcion;
                $tipoIdentificacion->tid_estado=$request->tid_estado;
                $tipoIdentificacion->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo el Tipo de identificacion',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el Tipo de identificacion',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipoIdentificacion = Tipo_Identificacion::getInstance();
            $datoEncontrado=$tipoIdentificacion->find($id);
            if($datoEncontrado!=null){
                $tipoIdentificacion->tid_estado=0;
                $tipoIdentificacion->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino el Tipo de identificacion',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el Tipo de identificacion',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }
}
