<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Motivo_Baja;
use Illuminate\Http\Request;

class MotivoBajaController extends Controller
{
    public function index()
    {

        
        try {
            $motivoBaja = Motivo_Baja::getInstance(); // * LLAMO AL SINGLETON
            $lista = $motivoBaja->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_Motivo_Baja_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_Motivo_Baja_VACIO',
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
            $motivoBaja = Motivo_Baja::getInstance();
            $motivoBaja->mba_descripcion=$request->mba_descripcion;
            $motivoBaja->mba_estado=$request->mba_estado;
            $motivoBaja->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'La Motivo_Baja se registro correctamente',
                'data' => $motivoBaja
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
            $motivoBaja = Motivo_Baja::getInstance();
            $datoEncontrado=$motivoBaja->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Motivo_Baja encontrada',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'La Motivo_Baja no se encontro',
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
            $motivoBaja = Motivo_Baja::getInstance();
            $datoEncontrado=$motivoBaja->find($id);
            if($datoEncontrado!=null){
                $motivoBaja->mba_descripcion=$request->mba_descripcion;
                $motivoBaja->mba_estado=$request->mba_estado;
                $motivoBaja->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo la Motivo_Baja',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Motivo_Baja',
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
            $motivoBaja = Motivo_Baja::getInstance();
            $datoEncontrado=$motivoBaja->find($id);
            if($datoEncontrado!=null){
                $motivoBaja->mba_estado=0;
                $motivoBaja->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino la Motivo_Baja',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Motivo_Baja',
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
