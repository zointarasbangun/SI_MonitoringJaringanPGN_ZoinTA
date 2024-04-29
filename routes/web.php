<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ServerController;
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

        Route::get('/dataAkun', [HomeController::class, 'dataAkun'])->name('dataAkun');
        Route::post('/store', [HomeController::class, 'store'])->name('addAcount');
        Route::post('/update/{id}', [HomeController::class, 'update'])->name('updateAkun');
        Route::delete('/delete/{id}', [HomeController::class, 'destroy'])->name('deleteAkun');
        Route::get('/editAkun/{id}', [HomeController::class, 'editAkun'])->name('editAkun');

        Route::get('/tambahAkun', [HomeController::class, 'tambahAkun'])->name('tambahAkun');

        Route::get('/dataKlien', [KlienController::class, 'dataKlien'])->name('dataKlien');
        Route::post('/tambahKlien', [KlienController::class, 'tambahKlien'])->name('tambahKlien');
        Route::get('/editKlien/{id}', [KlienController::class, 'editKlien'])->name('editKlien');
        Route::post('/updateKlien/{id}', [KlienController::class, 'updateKlien'])->name('updateKlien');
        Route::delete('/deleteKlien/{id}', [KlienController::class, 'destroyklien'])->name('deleteKlien');
        Route::get('/detailKlien/{id}', [KlienController::class, 'detailklien'])->name('detailKlien');

        Route::get('/dataServer', [ServerController::class, 'dataServer'])->name('dataServer');
        Route::post('/storeServer', [ServerController::class, 'store'])->name('addServer');
        Route::get('/editServer/{id}', [ServerController::class, 'edit'])->name('editServer');
        Route::post('/updateServer/{id}', [ServerController::class, 'update'])->name('updateServer');
        Route::delete('/deleteServer/{id}', [ServerController::class, 'destroy'])->name('deleteServer');

        Route::get('/dataPerangkat', [DeviceController::class, 'dataDevice'])->name('dataDevice');
        Route::post('/storePerangkat', [DeviceController::class, 'store'])->name('addDevice');
        Route::get('/editDevice/{id}', [DeviceController::class, 'edit'])->name('editDevice');
        Route::post('/updateDevice/{id}', [DeviceController::class, 'update'])->name('updateDevice');
        Route::delete('/deleteDevice/{id}', [DeviceController::class, 'destroy'])->name('deleteDevice');
        Route::get('/detailPerangkat/{id}', [DeviceController::class, 'detailDevice'])->name('detailDevice');

        Route::get('/klienlokasi', [MonitoringController::class, 'dataKlien'])->name('klienlokasi');
        Route::get('/serverlokasi', [MonitoringController::class, 'dataServer'])->name('serverlokasi');
        Route::get('/monitoringlokasi', [MonitoringController::class, 'dataMonitoring'])->name('monitoringlokasi');

        Route::get('datalogperbaikan', [LogController::class, 'dataLog'])->name('datalog');

    });

    Route::group(['middleware' => ['teknisi']], function () {

        Route::get('teknisi/dataKlien', [KlienController::class, 'teknisidataKlien'])->name('teknisi.dataKlien');
        Route::get('teknisi/detailKlien/{id}', [KlienController::class, 'teknisidetailKlien'])->name('teknisi.detailKlien');

        Route::get('teknisi/dataServer', [ServerController::class, 'teknisidataServer'])->name('teknisi.dataServer');

        Route::get('teknisi/dataPerangkat/', [DeviceController::class, 'teknisidataDevice'])->name('teknisi.dataDevice');

        Route::get('teknisi/detailPerangkat/{id}', [DeviceController::class, 'teknisidetailDevice'])->name('teknisi.detailDevice');


        Route::get('teknisi/klienlokasi', [MonitoringController::class, 'teknisidataKlien'])->name('teknisi.klienlokasi');
        Route::get('teknisi/serverlokasi', [MonitoringController::class, 'teknisidataServer'])->name('teknisi.serverlokasi');
        Route::get('teknisi/monitoringlokasi', [MonitoringController::class, 'teknisidataMonitoring'])->name('teknisi.monitoringlokasi');

        Route::get('teknisi/datalogperbaikan', [LogController::class, 'teknisidataLog'])->name('teknisi.datalog');


    });

    Route::group(['middleware' => ['klien']], function () {

    });
    Route::get('teknisi/tesPing', [DeviceController::class, 'tesPingAjax'])->name('tespingajax');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});
