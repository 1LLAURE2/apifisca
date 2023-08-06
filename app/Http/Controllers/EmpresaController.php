<?php

namespace App\Http\Controllers;

use App\Http\Resources\empresaResource;
use App\Models\Empresa as ModelsEmpresa;
use App\Models\Servicio;
use App\Models\Tipo_Servicio;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Throwable;

use function PHPUnit\Framework\isNull;

class EmpresaController extends Controller
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
            $empresas = ModelsEmpresa::getInstance(); // * LLAMO AL SINGLETON
            // $vehiculo=ModelVehiculo::getInstance();
            $lista = $empresas->get();
            // $lista=$empresas::with('servicio_id:descripcion')->get();
            // $lista=$empresas::with('servicio_id:descripcion')->get();
            //::orderBy("id", "desc")
            // $lista2=$empresas::with($servicio)->get();//
            // echo($lista2);
            if (sizeof($lista) > 0) {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_EMPRESA_OK',
                    'data' => $lista
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_EMPRESA_VACIO',
                    'data' => null
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 500, 'success' => false, 'message' => $th->getMessage(), 'data' => null]);
        } finally {
            //echo("RESOURCES");
            //return $empresas::find(1)->servicios()->get();
            return empresaResource::collection(ModelsEmpresa::with(['servicios', 'tipo_servicios'])->get());
            //with(['_empresa_servicios','_empresa_tipo_servicios'])
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
        $empresa = ModelsEmpresa::getInstance();
        // $representante=Representante_Legal::getInstance();    
        // $autorizacion=Autorizacion::getInstance();


        // $tipIdentifica=Tipo_Identificacion::findOrfail($request->tipo_identificacion_id);

        DB::beginTransaction();
        try {
            $empresa->emp_partida_registral = $request->emp_partida_registral;
            $empresa->emp_RUC = $request->emp_RUC;
            $empresa->emp_razon_social = $request->emp_razon_social;
            $empresa->emp_abreviatura = $request->emp_abreviatura;
            $empresa->emp_num_inscripcion_SUNARP = $request->emp_num_inscripcion_SUNARP;
            $empresa->emp_lug_inscripcion_SUNARP = $request->emp_lug_inscripcion_SUNARP;
            $empresa->emp_num_mz_km = $request->emp_num_mz_km;
            $empresa->emp_telefono = $request->emp_telefono;
            $empresa->emp_email = $request->emp_email;
            $empresa->emp_partida_electronica_SUNARP = $request->emp_partida_electronica_SUNARP;
            $empresa->emp_fec_inscripcion_SUNARP = $request->emp_fec_inscripcion_SUNARP;
            $empresa->emp_nombre_via = $request->emp_nombre_via;
            $empresa->emp_lote_int = $request->emp_lote_int;
            $empresa->emp_nom_urba = $request->emp_nom_urba;
            $empresa->emp_URL = $request->emp_URL;
            $empresa->emp_referencia = $request->emp_referencia;
            $empresa->emp_estado = $request->emp_estado;

            // $tipServicio=Tipo_Servicio::findOrfail($request->tipo_servicio_id);
            $tipServicio = Tipo_Servicio::find($request->tipo_servicio_id);

            // $existe_tipo_servicio = DB::table('tipo_servicio')   //realizo la sentencia para saber si existe
            //                         ->select('id')
            //                         ->where('id',$tipServicio);

            if ($tipServicio != null) {
                $empresa->tipo_servicio_id = $request->tipo_servicio_id;
            } else {
                DB::rollBack();
                return response()->json([
                    'code' => 500,
                    'success' => false,
                    'message' => 'No existe el ID tipo de Servicio',
                    'data' => null
                ]);
            }
            // $serv=Servicio::findOrfail($request->servicio_id);
            $serv = Servicio::find($request->servicio_id);
            $existe_servicio = DB::table('servicio')
                ->select('id')
                ->where('id', '=', $serv);

            if ($serv != null) {
                $empresa->servicio_id = $request->servicio_id;
            } else {
                DB::rollBack();
                return response()->json([
                    'code' => 500,
                    'success' => false,
                    'message' => 'No xiste el ID Servicio',
                    'data' => null
                ]);
            }


            $empresa->save();
            DB::commit();
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Se registro ok',
                'data' => $empresa
            ]);
        } catch (Throwable $th) {
            DB::rollBack();
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
                $empresa = ModelsEmpresa::getInstance();
                $empresa_encontrada = $empresa->find($id);
                if ($empresa_encontrada != null) {
                    return response()->json(
                        [
                            'code' => 200,
                            'success' => true,
                            'message' => 'Empresa encontrada',
                            'data' => empresaResource::collection(ModelsEmpresa::with(['servicios', 'tipo_servicios'])->where('id', $id)->get())
                        ]
                        // $empresa_encontrada
                        // empresaResource::collection(ModelsEmpresa::with(['servicios','tipo_servicios'])->get())
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
            return response()->json(['code' => 500, 'success' => false, 'message' => $th->getMessage(), 'data' => null]);
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
                $empresa = ModelsEmpresa::getInstance();
                $empresa_encontrada = $empresa->findOrFail($id);
                if ($empresa_encontrada != null) {
                    //TODO: Empresa con sus campos
                    $empresa->emp_partida_registral = $request->emp_partida_registral;
                    $empresa->emp_RUC = $request->emp_RUC;
                    $empresa->emp_razon_social = $request->emp_razon_social;
                    $empresa->emp_abreviatura = $request->emp_abreviatura;
                    $empresa->emp_num_inscripcion_SUNARP = $request->emp_num_inscripcion_SUNARP;
                    $empresa->emp_lug_inscripcion_SUNARP = $request->emp_lug_inscripcion_SUNARP;
                    $empresa->emp_num_mz_km = $request->emp_num_mz_km;
                    $empresa->emp_telefono = $request->emp_telefono;
                    $empresa->emp_email = $request->emp_email;
                    $empresa->emp_partida_electronica_SUNARP = $request->emp_partida_electronica_SUNARP;
                    $empresa->emp_fec_inscripcion_SUNARP = $request->emp_fec_inscripcion_SUNARP;
                    $empresa->emp_nombre_via = $request->emp_nombre_via;
                    $empresa->emp_lote_int = $request->emp_lote_int;
                    $empresa->emp_nom_urba = $request->emp_nom_urba;
                    $empresa->emp_URL = $request->emp_URL;
                    $empresa->emp_referencia = $request->emp_referencia;
                    $empresa->emp_estado = $request->emp_estado;

                    $tipServicioEncontrado = Tipo_Servicio::findOrFail($request->tipo_servicio_id);
                    if (isNull($tipServicioEncontrado)) {
                        return response()->json([
                            'code' => 400,
                            'success' => false,
                            'message' => 'No existe el Tipo de Servicio',
                            'data' => null
                        ]);
                    }
                    $empresa->tipo_servicio_id = $request->tipo_servicio_id;

                    $servicioEncontrado = Servicio::findOrFail($request->servicio_id);
                    if (isNull($servicioEncontrado)) {
                        return response()->json([
                            'code' => 400,
                            'success' => false,
                            'message' => 'No existe el Servicio',
                            'data' => null
                        ]);
                    }
                    $empresa->servicio_id = $request->servicio_id;
                }
                return response()->json(
                    [
                        'code' => 400,
                        'success' => false,
                        'message' => 'No se encontro el ID',
                        'data' => null
                    ]
                );
            } else {
                return response()->json(
                    [
                        'code' => 400,
                        'success' => false,
                        'message' => 'ID no es un dato numerico',
                        'data' => null
                    ]
                );
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
                $empresa = ModelsEmpresa::getInstance();
                $empresa_encontrada = $empresa->findOrFail($id);
                if ($empresa_encontrada != null) {
                    $empresa_encontrada->emp_estado = 0;
                    $empresa_encontrada->update();
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'SE ELIMINO LA EMPRESA CORRECTAMENTE',
                        'data' => $empresa_encontrada
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
