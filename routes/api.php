<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/invent01', [KategoriController::class, 'showAPIKategori']);
Route::post('invent02',[KategoriController::class, 'createAPIKategori']);
Route::get('/invent03/{id}', [KategoriController::class, 'detailAPIKategori']);
Route::delete('invent04/{kategori_id}',[KategoriController::class, 'deleteAPIKategori']);
Route::post('invent05/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);