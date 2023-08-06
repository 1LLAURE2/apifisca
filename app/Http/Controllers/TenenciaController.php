<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenencia;
use Illuminate\Http\Request;

class TenenciaController extends Controller
{
    public function index()
    {

        try {
            $tenencia = Tenencia::getInstance(); // * LLAMO AL SINGLETON
            $lista = $tenencia->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_TENENCIA_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_TENENCIA_VACIO',
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
            $tenencia = Tenencia::getInstance();
            $tenencia->ten_descripcion=$request->ten_descripcion;
            $tenencia->ten_estado=$request->ten_estado;
            $tenencia->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'La tenencia se registro correctamente',
                'data' => $tenencia
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
            $tenencia = Tenencia::getInstance();
            $datoEncontrado=$tenencia->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Tenencia encontrada',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'La Tenencia no se encontro',
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
            $tenencia = Tenencia::getInstance();
            $datoEncontrado=$tenencia->find($id);
            if($datoEncontrado!=null){
                $tenencia->ten_descripcion=$request->ten_descripcion;
                $tenencia->ten_estado=$request->ten_estado;
                $tenencia->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo la Tenencia',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Tenencia',
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
            $tenencia = Tenencia::getInstance();
            $datoEncontrado=$tenencia->find($id);
            if($datoEncontrado!=null){
                $tenencia->ten_estado=0;
                $tenencia->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino la Tenencia',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Tenencia',
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
