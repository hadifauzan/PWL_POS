<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function() {
//     return view('welcome');
// });

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postregister', [AuthController::class, 'postregister']);

Route::middleware(['auth'])->group(function(){
    
    Route::get('/', [WelcomeController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('update', [ProfileController::class, 'update'])->name('update');

    Route::middleware(['authorize:ADM'])->group(function() {
        Route::get('/user', [UserController::class, 'index']);
        Route::post('user/list', [UserController::class, 'list']);
        Route::get('user/create', [UserController::class, 'create']);
        Route::post('/user', [UserController::class, 'store']);
        Route::get('user/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('user/ajax', [UserController::class, 'store_ajax']);
        Route::get('user/{id}', [UserController::class, 'show']);
        Route::get('user/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('user/{id}/edit', [UserController::class, 'edit']);
        Route::put('user/{id}', [UserController::class, 'update']);
        Route::get('user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('user/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('user/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('user/{id}', [UserController::class, 'destroy']);
        Route::get('/user/import', [UserController::class, 'import']);
        Route::post('/user/import_ajax', [UserController::class, 'import_ajax']);
        Route::get('/user/export_excel', [UserController::class, 'export_excel']);
        Route::get('/user/export_pdf', [UserController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM'])->group(function() {
        Route::get('/level', [LevelController::class, 'index']); 
        Route::post('level/list', [LevelController::class, 'list']);
        Route::get('level/create', [LevelController::class, 'create']);
        Route::post('/level', [LevelController::class, 'store']);                 
        Route::get('level/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('level/ajax', [LevelController::class, 'store_ajax']);
        Route::get('level/{id}', [LevelController::class, 'show']);
        Route::get('level/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::get('level/{id}/edit', [LevelController::class, 'edit']);
        Route::put('level/{id}', [LevelController::class, 'update']);
        Route::get('level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('level/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('level/{id}', [LevelController::class, 'destroy']);
        Route::get('/level/import', [LevelController::class, 'import']);
        Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']);
        Route::get('/level/export_excel', [LevelController::class, 'export_excel']);
        Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG'])->group( function() {
        Route::get('/kategori', [KategoriController::class, 'index']);          
        Route::post('/kategori/list', [KategoriController::class, 'list']);     
        Route::get('/kategori/create', [KategoriController::class, 'create']);   
        Route::post('/kategori', [KategoriController::class, 'store']);         
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/kategori/{id}', [KategoriController::class, 'show']);     
        Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);  
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);    
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
        Route::get('/kategori/import', [KategoriController::class, 'import']);
        Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']);
        Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']);
        Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function() {
        Route::get('/supplier', [SupplierController::class, 'index']);        
        Route::post('/supplier/list', [SupplierController::class, 'list']);      
        Route::get('/supplier/create', [SupplierController::class, 'create']);   
        Route::post('/supplier', [SupplierController::class, 'store']);        
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/supplier/{id}', [SupplierController::class, 'show']);      
        Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);  
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::put('/supplier/{id}', [SupplierController::class, 'update']);     
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);
        Route::get('/supplier/import', [SupplierController::class, 'import']);
        Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']);
        Route::get('/supplier/export_excel', [SupplierController::class, 'export_excel']);
        Route::get('/supplier/export_pdf', [SupplierController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/barang', [BarangController::class, 'index']);          
        Route::post('barang/list', [BarangController::class, 'list']);     
        Route::get('barang/create', [BarangController::class, 'create']);   
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('barang/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('barang/ajax', [BarangController::class, 'store_ajax']);
        Route::get('barang/{id}', [BarangController::class, 'show']);
        Route::get('barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('barang/{id}/edit', [BarangController::class, 'edit']);
        Route::get('barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::put('barang/{id}', [BarangController::class, 'update']);
        Route::delete('barang/{id}', [BarangController::class, 'destroy']);
        Route::get('/barang/import', [BarangController::class, 'import']);
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']);
        Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/stok', [StokController::class, 'index']);         
        Route::post('/stok/list', [StokController::class, 'list']);
        Route::get('/stok/create_ajax', [StokController::class, 'create_ajax']);
        Route::post('/stok/ajax', [StokController::class, 'store_ajax']);
        Route::get('/stok/{id}/show_ajax', [StokController::class, 'show_ajax']);
        Route::get('/stok/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
        Route::put('/stok/{id}/update_ajax', [StokController::class, 'update_ajax']);
        Route::get('/stok/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
        Route::delete('/stok/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
        Route::get('/stok/import', [StokController::class, 'import']);
        Route::post('/stok/import_ajax', [StokController::class, 'import_ajax']);
        Route::get('/stok/export_excel', [StokController::class, 'export_excel']);
        Route::get('/stok/export_pdf', [StokController::class, 'export_pdf']);
    });
    
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/penjualan', [PenjualanController::class, 'index']);         
        Route::post('/penjualan/list', [PenjualanController::class, 'list']);
        Route::get('/penjualan/create_ajax', [PenjualanController::class, 'create_ajax']);
        Route::post('/penjualan/ajax', [PenjualanController::class, 'store_ajax']);
        Route::get('/penjualan/{id}/show_ajax', [PenjualanController::class, 'show_ajax']);
        Route::get('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);
        Route::delete('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);
        Route::get('/penjualan/import', [PenjualanController::class, 'import']);
        Route::post('/penjualan/import_ajax', [PenjualanController::class, 'import_ajax']);
        Route::get('/penjualan/export_excel', [PenjualanController::class, 'export_excel']);
        Route::get('/penjualan/export_pdf', [PenjualanController::class, 'export_pdf']);
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/detailpenjualan', [DetailPenjualanController::class, 'index']);         
        Route::post('/detailpenjualan/list', [DetailPenjualanController::class, 'list']);
        Route::get('/detailpenjualan/{id}/show_ajax', [DetailPenjualanController::class, 'show_ajax']);
        Route::get('/detailpenjualan/{id}/delete_ajax', [DetailPenjualanController::class, 'confirm_ajax']);
        Route::delete('/detailpenjualan/{id}/delete_ajax', [DetailPenjualanController::class, 'delete_ajax']);
        Route::get('/detailpenjualan/export_excel', [DetailPenjualanController::class, 'export_excel']);
        Route::get('/detailpenjualan/export_pdf', [DetailPenjualanController::class, 'export_pdf']);
    });  
});

// Route::get('/', [WelcomeController::class, 'index']);
