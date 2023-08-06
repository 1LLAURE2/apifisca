<?php

namespace App\Http\Controllers;

use App\Models\Autorizacion;
use App\Models\Empresa;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class AutorizacionController extends Controller
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
            $autorizacion = Autorizacion::getInstance();
            $lista = $autorizacion->get();
            if (sizeof($lista) > 0) {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'OPERACION EXITOSA',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'NO EXISTE INFORMACION',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            //throw $th;
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
            $autorizacion = Autorizacion::getInstance();
            $autorizacion->aut_marco_legal = $request->aut_marco_legal;
            $autorizacion->aut_num_expediente = $request->aut_num_expediente;
            $autorizacion->aut_num_resolucion = $request->aut_num_resolucion;
            $autorizacion->aut_fec_expediente = now();
            $autorizacion->aut_fec_resolucion = $request->aut_fec_resolucion;
            $autorizacion->aut_anio_vigencia = $request->aut_anio_vigencia;
            $autorizacion->aut_objeto_social = $request->aut_objeto_social;
            $autorizacion->aut_observacion = $request->aut_observacion;
            $autorizacion->aut_estado = $request->aut_estado;
            $empresa_encontrada = Empresa::find($request->empresa_id);
            if ($empresa_encontrada != null) {
                $autorizacion->empresa_id = $request->empresa_id;

                $autorizacion->save();
                return response()->json([
                    'code' => 200,
                    'success' => false,
                    'message' => 'La Auorizacion se registro correctamente',
                    'data' => $autorizacion
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'LA EMPRESA SELECCIONADA NO EXISTE',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            //throw $th;
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
            //code...
            if (is_numeric($id)) {
                $autorizacion = Autorizacion::getInstance();
                $autorizacion_encontrada = $autorizacion->find($id);

                if ($autorizacion_encontrada != null) {
                    return response()->json([
                        'code' => 200,
                        'success' => true,
                        'message' => 'AUTORIZACION ENCONTRADA',
                        'data' => $autorizacion_encontrada
                    ]);
                }
                return response()->json([
                    'code' => 400,
                    'success' => false,
                    'message' => 'ID NO ENCONTRADO',
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
            //throw $th;
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
        //NO SE DEBE ACTUALIZAR
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
            $autorizaciom = Autorizacion::getInstance();
            $autorizaciom_encontrada = $autorizaciom->find($id);
            if ($autorizaciom_encontrada!=null) {
                $autorizaciom_encontrada->aut_estado = 0;
                $autorizaciom_encontrada->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'SE ELIMINO LA AUTORIZACION',
                    'data' => $autorizaciom_encontrada
                ]);
            }
            
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'NO SE ENCONTRO EL ID DE AUTORIZACION',
                'data' => null
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => $th->getMessage(),
                'data' => null
            ]);
        }
    }
}
