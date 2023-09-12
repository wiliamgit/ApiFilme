<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerFilme;
use App\Http\Controller\Delete;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/',function(){
    return response()->json([
'sucess' => true
    ]);
});


Route::get('/mostrar',[ControllerFilme::class,'mostrar']);
Route::get('/buscar/{id}',[ControllerFilme::class,'buscarId']);
Route::post('/cadastrar',[ControllerFilme::class,'cadastrar']);
Route::put('/atualizar/{id}',[ControllerFilme::class,'atualizar']);
Route::delete('/deletar/{id}',[ControllerFilme::class,'deletar']);