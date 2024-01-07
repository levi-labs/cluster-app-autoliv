<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\ProsesPerhitunganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstantPerhitunganController;
use App\Http\Controllers\ReportKeluarController;
use App\Http\Controllers\ReportMasukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('pages.auth.login');
});


Route::group(['auth' => 'middleware'], function () {

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('index', 'index');
    });

    Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
        Route::get('index', 'index');
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::get('edit/{kategori}', 'edit');
        Route::post('update/{kategori}', 'update');
        Route::get('delete/{kategori}', 'destroy');
    });

    Route::controller(BarangController::class)->prefix('barang')->group(function () {
        Route::get('index', 'index');
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::post('import', 'importExcel');
        Route::get('show/{barang}', 'show');
        Route::get('edit/{barang}', 'edit');
        Route::post('update/{barang}', 'update');
        Route::get('delete/{barang}', 'destroy');
    });
    Route::controller(BarangMasukController::class)->prefix('barang-masuk')->group(function () {
        Route::get('index', 'index');
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::post('import', 'importExcel');
        Route::get('show/{barangMasuk}', 'show');
        Route::get('edit/{barangMasuk}', 'edit');
        Route::post('update/{barangMasuk}', 'update');
        Route::get('delete/{barangMasuk}', 'destroy');
    });
    Route::controller(BarangKeluarController::class)->prefix('barang-keluar')->group(function () {
        Route::get('index', 'index');
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::post('import', 'importExcel');
        Route::get('edit/{barangKeluar}', 'edit');
        Route::post('update/{barangKeluar}', 'update');
        Route::get('delete/{barangKeluar}', 'destroy');

        Route::get('k-means-form', 'formKmeans');
        Route::post('k-means-calculate', 'kmeansProses');
    });
    Route::controller(ReportMasukController::class)->prefix('report-masuk')->group(function () {
        Route::get('index', 'index');
        Route::post('post-report-masuk', 'sendReportMasuk');
    });
    Route::controller(ReportKeluarController::class)->prefix('report-keluar')->group(function () {
        Route::get('index', 'index');
        Route::post('post-report-keluar', 'sendReportKeluar');
    });

    Route::controller(UserManagementController::class)->prefix('user-management')->group(function () {
        Route::get('index', 'index');
        Route::get('create', 'create');
        Route::post('store', 'store');
        Route::post('import', 'importExcel');
        Route::get('edit/{user}', 'edit');
        Route::post('update/{user}', 'update');
        Route::get('delete/{user}', 'destroy');
        Route::get('reset-password/{user}', 'resetPassword');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('index', 'editPassword');
        Route::post('update', 'updatePassword');
    });

    Route::controller(InstantPerhitunganController::class)->prefix('kmeans')->group(function () {
        Route::get('index', 'index');
        Route::post('import-file', 'importExcel');
        Route::get('create-perhitungan', 'createPerhitungan');
        Route::post('proses-perhitungan', 'prosesPerhitungan');
        Route::get('store-perhitungan', 'storePerhitungan');
    });
});



Route::get('logout', function () {
    Auth::logout();
    return view('pages.auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
