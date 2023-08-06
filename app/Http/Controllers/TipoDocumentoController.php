<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Tipo_Documento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function index()
    {

        
        try {
            $tipoDocumento = Tipo_Documento::getInstance(); // * LLAMO AL SINGLETON
            $lista = $tipoDocumento->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_Tipo_Documento_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_Tipo_Documento_VACIO',
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
            $tipoDocumento = Tipo_Documento::getInstance();
            $tipoDocumento->tdo_descripcion=$request->tdo_descripcion;
            $tipoDocumento->tdo_estado=$request->tdo_estado;
            $tipoDocumento->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'La Tipo_Documento se registro correctamente',
                'data' => $tipoDocumento
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
            $tipoDocumento = Tipo_Documento::getInstance();
            $datoEncontrado=$tipoDocumento->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Tipo_Documento encontrada',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'La Tipo_Documento no se encontro',
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
            $tipoDocumento = Tipo_Documento::getInstance();
            $datoEncontrado=$tipoDocumento->find($id);
            if($datoEncontrado!=null){
                $tipoDocumento->tdo_descripcion=$request->tdo_descripcion;
                $tipoDocumento->tdo_estado=$request->tdo_estado;
                $tipoDocumento->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo la Tipo_Documento',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Tipo_Documento',
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
            $tipoDocumento = Tipo_Documento::getInstance();
            $datoEncontrado=$tipoDocumento->find($id);
            if($datoEncontrado!=null){
                $tipoDocumento->tdo_estado=0;
                $tipoDocumento->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino la Tipo_Documento',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro la Tipo_Documento',
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
