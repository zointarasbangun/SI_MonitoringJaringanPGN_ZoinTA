<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/create', [HomeController::class, 'create'])->name('create');
        Route::post('/store', [HomeController::class, 'store'])->name('store');

        Route::put('/update/{id}', [HomeController::class, 'update'])->name('update');
        Route::delete('/delete', [HomeController::class, 'delete'])->name('delete');
        Route::get('/dataAkun', [HomeController::class, 'dataAkun'])->name('dataAkun');
        Route::get('/editAkun/{id}', [HomeController::class, 'editAkun'])->name('editAkun');
        Route::get('/tambahAkun', [HomeController::class, 'tambahAkun'])->name('tambahAkun');
        Route::get('/dataKlien', [HomeController::class, 'dataKlien'])->name('dataKlien');
        Route::get('/tambahKlien', [HomeController::class, 'tambahKlien'])->name('tambahKlien');
        Route::get('/editKlien/{id}', [HomeController::class, 'editKlien'])->name('editKlien');
        Route::get('/dataServer', [HomeController::class, 'dataServer'])->name('dataServer');
        Route::get('/tambahServer', [HomeController::class, 'tambahServer'])->name('tambahServer');
        Route::get('/editServer/{id}', [HomeController::class, 'editServer'])->name('editServer');
        Route::get('/perangkat', [HomeController::class, 'perangkat'])->name('perangkat');
    });
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});
