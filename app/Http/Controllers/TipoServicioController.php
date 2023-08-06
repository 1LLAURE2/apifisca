<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tipo_Servicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        try {
            $tipo_servicio = Tipo_Servicio::getInstance(); // * LLAMO AL SINGLETON
            $lista = $tipo_servicio->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_TIPO_SERVICIO_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_TIPO_SERVICIO_VACIO',
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
            $tipoServicio = Tipo_Servicio::getInstance();
            $tipoServicio->tse_descripcion=$request->tse_descripcion;
            $tipoServicio->tse_estado=$request->tse_estado;
            $tipoServicio->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'El tipo de servicio se registro correctamente',
                'data' => $tipoServicio
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
            $tipoServicio = Tipo_Servicio::getInstance();
            $datoEncontrado=$tipoServicio->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Tipo de Servicio encontrado',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'El servicio no se encontro',
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
            $tipoServicio = Tipo_Servicio::getInstance();
            $datoEncontrado=$tipoServicio->find($id);
            if($datoEncontrado!=null){
                $tipoServicio->tse_descripcion=$request->tse_descripcion;
                $tipoServicio->tse_estado=$request->tse_estado;
                $tipoServicio->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo el tio se Servicio',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el tipo de servicio',
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
            $tipoServicio = Tipo_Servicio::getInstance();
            $datoEncontrado=$tipoServicio->find($id);
            if($datoEncontrado!=null){
                $tipoServicio->tse_estado=0;
                $tipoServicio->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino el tipo se Servicio',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el tipo de servicio',
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
