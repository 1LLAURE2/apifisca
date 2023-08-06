<?php

namespace App\Http\Controllers;

use App\Models\Documentacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

use Throwable;

class DocumentacionController extends Controller
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
            $documentacion = Documentacion::getInstance(); // * LLAMO AL SINGLETON
            $lista = $documentacion->get();
            if (sizeof($lista) > 0) {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_DOCUMENTACION_OK',
                    'data' => $lista
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_DOCUMENTACION_VACIO',
                    'data' => null
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 500, 'success' => false, 'message' => $th->getMessage(), 'data' => null]);
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
        //TODO: SERVICIO
        $documentacion = Documentacion::getInstance();

        try {
            $documentacion->doc_num_exp = $request->doc_num_exp;
            $documentacion->doc_num_res = $request->doc_num_res;
            $documentacion->doc_fec_exp = $request->doc_fec_exp;
            $documentacion->doc_fec_res = $request->doc_fec_res;
            $documentacion->doc_observacion = $request->doc_observacion;
            $vehiculo=Vehiculo::getInstance();
            $vehiculoEncontrado=$vehiculo->find($request->vehiculo_id);
            if($vehiculoEncontrado!=null){
                $documentacion->vehiculo_id = $request->vehiculo_id;
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se registro ok',
                    'data' => $documentacion
                ]);
            }
            
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => 'No xiste el ID del Vehiculo',
                'data' => null
            ]);
        } catch (Throwable $th) {
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
        //
        try {
            if (is_numeric($id)) {
                $documentacion = Documentacion::getInstance();
                $documentacion_encontrada = $documentacion->find($id);
                if($documentacion_encontrada!= null) {
                    return response()->json(
                        [
                            'code' => 200,
                            'success' => true,
                            'message' => 'Documentacion no encontrada',
                            'data' => $documentacion_encontrada
                        ]
                    );
                }
                    
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'ID NO VALIDO',
                    'data' => null
                ]);
            } else {
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'El id debe ser un entero',
                    'data' => null
                ]);
            }
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
            if (is_numeric($id)) {
                $documentacion = Documentacion::getInstance();
                $documentacion_encontrada = $documentacion->find($id);
                if($documentacion_encontrada!= null) {
                    $documentacion->doc_num_exp = $request->doc_num_exp;
                    $documentacion->doc_num_res = $request->doc_num_res;
                    $documentacion->doc_fec_exp = $request->doc_fec_exp;
                    $documentacion->doc_fec_res = $request->doc_fec_res;
                    $documentacion->doc_observacion = $request->doc_observacion;

                    $vehiculo=Vehiculo::getInstance();
                    $vehiculoEncontrado=$vehiculo->find($request->vehiculo_id);
                    if ($vehiculoEncontrado!=null) {
                        $documentacion->vehiculo_id=$request->vehiculo_id;
                        $documentacion->save();
                        return response()->json([
                            'code' => 400,
                            'success' => false,
                            'message' => 'Se registro la documentacion',
                            'data' => null
                        ]);
                    }

                    return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'No el vehiculo',
                    'data' => null
                ]);
                }
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'No existe la documentacion',
                    'data' => null
                ]);
                
            }
            return response()->json(
                [
                    'code' => 400,
                    'success' => false,
                    'message' => 'ID no es un dato numerico',
                    'data' => null
                ]
            );
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            if (is_numeric($id)) {
                $documentacion = Documentacion::getInstance();
                $documentacion_encontrada = $documentacion->find($id);
                if($documentacion_encontrada!= null) {
                    //FIXME: ADICIONAR CAMPO DE DOC_ESTADO EN LA MIGRACION NO EXISTE 
                    // ? puede mostrar erroe al eliminar ya que no existe el campo
                    $documentacion_encontrada->doc_estado = 0;
                    $documentacion_encontrada->update();
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'SE ELIMINO LA DOCUMENTACION CORRECTAMENTE',
                        'data' => $documentacion_encontrada
                    ]);
                }

                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'El id no existe',
                    'data' => null
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'EL ID NO ES NUMERICO',
                'data' => null
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
}
