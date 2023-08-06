<?php

use App\Http\Controllers\AutorizacionController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\RepresentanteLegalController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\V1\ProductsController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\V1\ServicioController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    // * Prefijo V1, todo lo que este dentro de este grupo se accedera escribiendo v1 en el navegador, es decir /api/v1/*
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('products', [ProductsController::class, 'index']);
    Route::get('products/{id}', [ProductsController::class, 'show']);
    //TODO: INICIO
    Route::get('empresa', [EmpresaController::class, 'index']);
    Route::post('empresa', [EmpresaController::class, 'store']);
    Route::get('empresa/{id}', [EmpresaController::class, 'show']);
    Route::put('empresa/{id}', [EmpresaController::class, 'update']);
    Route::delete('empresa/{id}', [EmpresaController::class, 'destroy']);

    Route::get('autorizacion', [AutorizacionController::class, 'index']);
    Route::get('autorizacion/{id}', [AutorizacionController::class, 'show']);
    Route::post('autorizacion', [AutorizacionController::class, 'store']);
    Route::delete('autorizacion/{id}', [AutorizacionController::class, 'destroy']);

    Route::get('representante', [RepresentanteLegalController::class, 'index']);
    Route::delete('representante/{id}', [RepresentanteLegalController::class, 'destroy']);
    Route::post('representante', [RepresentanteLegalController::class, 'store']);

    Route::get('tipo-servicio', [TipoServicioController::class, 'index']);
    Route::get('tipo-servicio/{id}', [TipoServicioController::class, 'show']);
    Route::put('tipo-servicio/{id}', [TipoServicioController::class, 'update']);
    Route::delete('tipo-servicio/{id}', [TipoServicioController::class, 'destroy']);
    Route::post('tipo-servicio', [TipoServicioController::class, 'store']);

    Route::get('servicio', [ServicioController::class, 'index']);
    Route::get('servicio/{id}', [ServicioController::class, 'show']);
    Route::put('servicio/{id}', [ServicioController::class, 'update']);
    Route::delete('servicio/{id}', [ServicioController::class, 'destroy']);
    Route::post('servicio', [ServicioController::class, 'store']);

    Route::get('tipo-identificacion', [TipoIdentificacionController::class, 'index']);
    Route::get('tipo-identificacion/{id}', [TipoIdentificacionController::class, 'show']);
    Route::put('tipo-identificacion/{id}', [TipoIdentificacionController::class, 'update']);
    Route::delete('tipo-identificacion/{id}', [TipoIdentificacionController::class, 'destroy']);
    Route::post('tipo-identificacion', [TipoIdentificacionController::class, 'store']);

    //TODO FIN
    // * JwtMiddleware importante en el acceso a los recursos del API
    Route::group(['middleware' => ['jwt.verify']], function() {
        //TODO: lo que este dentro de este grupo requiere verificación de usuario.
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::post('products', [ProductsController::class, 'store']);
        Route::put('products/{id}', [ProductsController::class, 'update']);
        Route::delete('products/{id}', [ProductsController::class, 'destroy']);
        
        // TODO: Se deben agregar mas metodos
        // !
        // ?
        // * *

        // FIXME: REPARAR, ARREGLARME
        // HACK: ATAJO O ABREVIADO
        // XXX: 
        // [ ]: Hacer algo o hacer esto primero y luego [] ....
        // [x]: Algo que he hecho
        // BUG: ERROR


    });
    //

});