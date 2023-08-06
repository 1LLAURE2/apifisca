<?php

namespace App\Http\Controllers;

use App\Models\Baja_Vehicular;
use App\Models\Motivo_Baja;
use App\Models\Tipo_Documento;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class BajaVehicularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $bajaVehicular = Baja_Vehicular::getInstance();
            $lista = $bajaVehicular->get();
            if (sizeof($lista) > 0) {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'OPERACION EXITOSA',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'NO EXISTEN DATOS',
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
        //
        try {
            $bajaVehicular = Baja_Vehicular::getInstance();
            $bajaVehicular->baj_num_documento = $request->documento;
            $bajaVehicular->baj_num_resolucion = $request->baj_num_resolucion;
            $bajaVehicular->baj_fec_documento = $request->baj_fec_documento;
            $bajaVehicular->baj_fec_resolucion = $request->baj_fec_resolucion;
            $bajaVehicular->baj_observacion = $request->baj_observacion;

            $motivo_baja = Motivo_Baja::getInstance();
            $motivo_encontrado = $motivo_baja->find($request->motivo_baja_id);
            if ($motivo_encontrado != null) {
                $bajaVehicular->motivo_baja_id = $request->motivo_baja_id;
            } else {
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'NO EXISTE EL ID DEL MOTIVO DE BAJA',
                    'data' => null
                ]);
            }

            $tipo_documento = Tipo_Documento::getInstance();
            $documento_encontrado = $tipo_documento->find($request->tipo_documento_id);
            if ($documento_encontrado != null) {
                $bajaVehicular->tipo_documento_id = $request->tipo_documento_id;
            } else {
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'NO EXISTE EL ID DEL DOCUMENTO',
                    'data' => null
                ]);
            }

            $vehiculo = Vehiculo::getInstance();
            $vehiculo_encontrado = $vehiculo->find($request->vehiculo_id);
            if ($vehiculo_encontrado != null) {
                $bajaVehicular->vehiculo_id = $request->vehiculo_id;
            } else {
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'NO EXISTE EL ID DEL VEHICULO',
                    'data' => null
                ]);
            }
            // [x]: al momento de dar baja vehicular el vehiculo debe estar en 0 
            $vehiculo_encontrado->veh_estado=0;
            $vehiculo->update();

            $bajaVehicular->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 200,
                'success' => true,
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
                $bajaVehicular = Baja_Vehicular::getInstance();
                $bajaVehicular_encontrado = $bajaVehicular->find($id);
                if ($bajaVehicular_encontrado != null) {
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'OPERACION EXITOSA',
                        'data' => $bajaVehicular_encontrado
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'EL ID NO EXISTE',
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
                'code' => 400,
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
                $bajaVehicular = Baja_Vehicular::getInstance();
                $bajaVehicular_encontrado = $bajaVehicular->find($id);
                $bajaVehicular_encontrado->baj_num_documento = $request->baj_num_documento;
                $bajaVehicular_encontrado->baj_num_resolucion = $request->baj_num_resolucion;
                $bajaVehicular_encontrado->baj_fec_documento = $request->baj_fec_documento;
                $bajaVehicular_encontrado->baj_fec_resolucion = $request->baj_fec_resolucion;
                $bajaVehicular_encontrado->baj_observacion = $request->baj_observacion;

                $motivo_baja = Motivo_Baja::getInstance();
                $motivo_encontrado = $motivo_baja->find($request->motivo_baja_id);
                if ($motivo_encontrado != null) {
                    $bajaVehicular_encontrado->motivo_baja_id = $request->motivo_baja_id;
                } else {
                    return response()->json([
                        'code' => 400,
                        'success' => false,
                        'message' => 'NO EXISTE EL ID DEL MOTIVO DE BAJA',
                        'data' => null
                    ]);
                }

                $tipo_documento = Tipo_Documento::getInstance();
                $documento_encontrado = $tipo_documento->find($request->tipo_documento_id);
                if ($documento_encontrado != null) {
                    $bajaVehicular_encontrado->tipo_documento_id = $request->tipo_documento_id;
                } else {
                    return response()->json([
                        'code' => 400,
                        'success' => false,
                        'message' => 'NO EXISTE EL ID DEL DOCUMENTO',
                        'data' => null
                    ]);
                }

                $vehiculo = Vehiculo::getInstance();
                $vehiculo_encontrado = $vehiculo->find($request->vehiculo_id);
                if ($vehiculo_encontrado != null) {
                    $bajaVehicular_encontrado->vehiculo_id = $request->vehiculo_id;
                } else {
                    return response()->json([
                        'code' => 400,
                        'success' => false,
                        'message' => 'NO EXISTE EL ID DEL VEHICULO',
                        'data' => null
                    ]);
                }
                $bajaVehicular_encontrado->update();
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'EL ID NO ES NUMERICO',
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
        // !NO SE DEBERIA ELIMINAR LA BAJA VEHICULAR, HAY PROBLEMAS
        // !NO USAR POR EL MOMENTO 
        // ? PARACE QUE LA BAJA NO SE HACE AQUI SOLO SE HACE EN EL MODELO VEJICULO
        try {
            if(is_numeric($id)){
                $bajaVehicular=Baja_Vehicular::getInstance();
                $bajaVehicular_encontrado=$bajaVehicular->find($id);
                if($bajaVehicular_encontrado!=null){
                    //$bajaVehicular->vehiculos()->veh_estado=0;
                    //probar
                    // $vehiculo=Vehiculo::getInstance();
                    // $vehiculo->bajas_vehiculares()->baj_observacion='';
                    //fin probar
                    // ? NO EXISTE ESTADO POR QUE, LA BAJA ES EN EL MODELO VEHICULO
                    return response()->json([
                        'code' => 200,
                        'success' => false,
                        'message' => 'SE ELIMINO',
                        'data' => null
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'EL ID NO EXISTE',
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
                'code' => 400,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }
}
