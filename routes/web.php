<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout',[UserController::class, 'logout'])->name('logout');
    
    Route::resource('users', UserController::class);
    Route::resource('konfigurasi/roles', RoleController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('outlet', OutletController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::post('/getpesanandetail', [TransaksiController::class,"getpesanandetail"]);


Route::get("/tes", function(){
    $data = App\Models\Pemesanan::with("detail_pesanan")->first()->detail_pesanan->first();
   

    dd($no);
    

  //  dd($datapelanggan);
});

//Akses Data Pesanan
Route::post("/getdetailpesanan",[PemesananController::class, "getdetailpesanan"]);

require __DIR__.'/auth.php';