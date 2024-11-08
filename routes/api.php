<?php

use Illuminate\Http\Request;
use illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controller\Api\LoginController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/levels', [LevelController::class, 'index']);
Route::post ('/levels', [LevelController::class, 'store']);
Route::put('/levels/{level}', [LevelController::class, 'show']);
Route::put('/levels/{level}', [LevelController::class, 'update']);
Route::delete('/levels/{level}', [LevelController::class, 'destroy']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post ('/barang', [BarangController::class, 'store']);
Route::put('/barang/{barang}', [BarangController::class, 'show']);
Route::put('/barang/{barang}', [BarangController::class, 'update']);
Route::delete('/barang/{barang}', [BarangController::class, 'destroy']);

Route::get('/user', [UserController::class, 'index']);
Route::post ('/user', [UserController::class, 'store']);
Route::put('/user/{user}', [UserController::class, 'show']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::post ('/kategori', [KategoriController::class, 'store']);
Route::put('/kategori/{kategori}', [KategoriController::class, 'show']);
Route::put('/kategori/{katgori}', [KategoriController::class, 'update']);
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy']);

Route::post('/register1', App\Http\Controllers\Api\RegisterController::class)->name('register1');
Route::get('barang/{barang}', [BarangController::class, 'show']);