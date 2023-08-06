<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {

        
        try {
            $servicio = Servicio::getInstance(); // * LLAMO AL SINGLETON
            $lista = $servicio->get();
            if(sizeof($lista)>0){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'INDEX_SERVICIO_OK',
                    'data' => $lista
                ]);
            }
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'INDEX_SERVICIO_VACIO',
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
            $Servicio = Servicio::getInstance();
            $Servicio->ser_descripcion=$request->ser_descripcion;
            $Servicio->ser_estado=$request->ser_estado;
            $Servicio->save();

            return response()->json([
                'code' => 200,
                'success' => false,
                'message' => 'El Servicio se registro correctamente',
                'data' => $Servicio
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
            $Servicio = Servicio::getInstance();
            $datoEncontrado=$Servicio->find($id);
            if($datoEncontrado!=null){
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Servicio encontrado',
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
            $Servicio = Servicio::getInstance();
            $datoEncontrado=$Servicio->find($id);
            if($datoEncontrado!=null){
                $Servicio->ser_descripcion=$request->ser_descripcion;
                $Servicio->ser_estado=$request->ser_estado;
                $Servicio->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se actualizo el Servicio',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el Servicio',
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
            $Servicio = Servicio::getInstance();
            $datoEncontrado=$Servicio->find($id);
            if($datoEncontrado!=null){
                $Servicio->ser_estado=0;
                $Servicio->update();
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'message' => 'Se elimino el Servicio',
                    'data' => $datoEncontrado
                ]);
            }
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' => 'No se encontro el Servicio',
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
