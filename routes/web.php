<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka
Route::get('login', [AuthController:: class, 'login' ])->name('login' );
Route::post('login', [AuthController:: class, 'postlogin' ]);
Route::get('logout', [AuthController:: class, 'logout' ])->middleware('auth' );
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware (['auth' ])->group(function(){ // artinya semua route di dalam group ini harus login dulu

    // route level

    // artinya semua route di dalam group ini harus punya role ADM (Administrator)
    Route::middleware( ['authorize: ADM' ]) ->group (function ( ) {
        Route::get ('/level', [LevelController::class, 'index' ] );
        Route::post ('/level/list', [LevelController::class, 'list' ]) ; // untuk list json datatables
        Route::get ('/level/create', [LevelController::class, 'create']) ;
        Route::post ('/level', [LevelController::class, 'store' ]) ;
        Route::get ('/level/{id}/edit', [LevelController::class, 'edit' ]); // untuk tampilkan form edit
        Route::put ('/level/{id}', [LevelController::class, 'update']) ; // untuk proses update data
        Route::delete('/level/{id}', [LevelController::class, 'destroy' ]) ; // untuk proses hapus data 
    });

    Route::middleware(['authorize:ADM,MNG'])-> group (function() {
        Route::get('/barang', [BarangController::class, 'index']);          //menampilkan halaman awal barang
        Route::post('/barang/list', [BarangController::class, 'list']);      //menampilkan data barang dalam bentuk json untuk database
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/barang_ajax', [BarangController::class, 'store_ajax']);     // Menyimpan data barang baru Ajax
        Route::get('/barang{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit barang Ajax
        Route::put('/barang{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data barang Ajax
        Route::get('/barang{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk menampilkan form barang delete barang Ajax
        Route::delete('/barang{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk menghapus data barang  Ajax
    });
    

// masukkan semua route yang perlu autentikasi di sini
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk databales
    Route::get('/create', [UserController::class, 'create']);   //menampilkan halaman form tambah user 
    Route::post('/', [UserController::class, 'store']);         //menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);         //menampilkan  halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);         //menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  //menampilkan halaman form edit user  
    Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user 
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     //menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);     //menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);     // Untuk hapus data user ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user 
    });

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal untuk supplier
    Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data supplier dalam bentuk json untuk databales
    Route::get('/create', [SupplierController::class, 'create']);   //menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);         //menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supplier Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);     // Menyimpan data supplier baru Ajax
    Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menampilkan halaman form edit supplier 
    Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data supplier 
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']); // Menampilkan halaman detail supplier Ajax
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit supplier Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data supplier Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk menampilkan form supplier delete kategori Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk menghapus data supplier  Ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); //menghapus data supplier 
    });

Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data kategori dalam bentuk json untuk databales
    Route::get('/create', [KategoriController::class, 'create']);   //menampilkan halaman form tambah kategori 
    Route::post('/', [KategoriController::class, 'store']);         //menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);  //Menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);         //menyimpan data kategori baru Ajax
    Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menampilkan halaman form edit kategori  
    Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data kategori 
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // Menampilkan halaman detail kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan halaman form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete kategori Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk menghapus data kategori  Ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data kategori 
    });

// Route::group(['prefix' => 'level'], function () {
//     Route::get('/', [LevelController::class, 'index']);         // menampilkan halaman awal level
//     Route::post('/list', [LevelController::class, 'list']);     // menampilkan data level dalam bentuk json untuk datatables
//     Route::get('/create', [LevelController::class, 'create']);  // menampilkan halaman form tambah level
//     Route::post('/', [LevelController::class, 'store']);        // menyimpan data level baru
//     Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
//     Route::post('/ajax', [LevelController::class, 'store_ajax']);     // Menyimpan data user baru Ajax
//     Route::get('/{id}', [LevelController::class, 'show']);      // menampilkan detail level
//     Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
//     Route::put('/{id}', [LevelController::class, 'update']);    // menyimpan perubahan data level
//     Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // Menampilkan halaman detail level
//     Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
//     Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
//     Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete level Ajax
//     Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk menghapus data level Ajax
//     Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
//     });

});

