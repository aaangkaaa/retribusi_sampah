<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MasterKecamatanController;
use App\Http\Controllers\MasterKelurahanController;
use App\Http\Controllers\MasterRwController;
use App\Http\Controllers\MasterRtController;
use App\Http\Controllers\MasterWrController;
use App\Http\Controllers\PenetapanWrController;
use App\Http\Controllers\MasterTarifController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PimpinanKecamatanController;
use App\Http\Controllers\DashboardController as DashboardController;

// Route yang dapat diakses tanpa login
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::post('/search-npwr', [App\Http\Controllers\LandingController::class, 'searchNpwr']);
Route::view('/login', 'login')->name('login');
// Registrasi dan Login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

// Route yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::view('/home', 'home')->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cetak-pdf', [PdfController::class, 'cetak']);
});

// Mengambil Data Pengguna (dengan token)
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);

// Logout Pengguna
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    // Remove duplicate dashboard route from here
    Route::view('/home', 'home')->name('home');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cetak-pdf', [PdfController::class, 'cetak']);
    Route::get('master-tarif', [MasterTarifController::class, 'index']);
    Route::post('master-tarif/delete', [MasterTarifController::class, 'delete']);
    Route::get('master-tarif/data', [MasterTarifController::class, 'getData']);
    Route::post('master-tarif/save-data', [MasterTarifController::class, 'save']);
    Route::view('/master-tarif', 'm-tarif')->name('master-tarif');
    Route::get('master-kecamatan', [MasterKecamatanController::class, 'index']);
    Route::get('master-kecamatan/data', [MasterKecamatanController::class, 'getData']);
    Route::post('master-kecamatan/save-data', [MasterKecamatanController::class, 'save']);
    Route::view('/master-kecamatan', 'm-kecamatan')->name('master-kecamatan');
    Route::get('master-kelurahan', [MasterKelurahanController::class, 'index']);
    Route::get('master-kelurahan/data', [MasterKelurahanController::class, 'getData']);
    Route::post('master-kelurahan/save-data', [MasterKelurahanController::class, 'save']);
    Route::view('/master-kelurahan', 'm-kelurahan')->name('master-kelurahan');
    Route::get('master-rw', [MasterRwController::class, 'index']);
    Route::get('master-rw/data', [MasterRwController::class, 'getData']);
    Route::get('master-rw/daftar-rw', [MasterRwController::class, 'getDataRw']);
    Route::get('master-rw/data-kecamatan', [MasterRwController::class, 'getDataKecamatan']);
    Route::get('master-rw/data-kelurahan', [MasterRwController::class, 'getDataKelurahan']);
    Route::post('master-rw/save-data', [MasterRwController::class, 'save']);
    Route::view('/master-rw', 'm-rw')->name('master-rw');
    Route::get('master-wr', [MasterWrController::class, 'index']);
    Route::get('master-wr/data', [MasterWrController::class, 'getData']);
    Route::get('master-wr/daftar-wr', [MasterWrController::class, 'getDataWr']);
    Route::get('master-wr/data-byId', [MasterWrController::class, 'getDataById']);
    Route::get('master-wr/max-kode', [MasterWrController::class, 'getMaxKode']);
    Route::get('master-wr/data-kecamatan', [MasterWrController::class, 'getDataKecamatan']);
    Route::get('master-wr/data-kelurahan', [MasterWrController::class, 'getDataKelurahan']);
    Route::get('master-wr/data-tarif', [MasterWrController::class, 'getDataTarif']);
    Route::get('master-wr/data-rw', [MasterWrController::class, 'getDataRw']);
    Route::get('master-wr/data-rt', [MasterWrController::class, 'getDataRt']);
    Route::post('master-wr/delete', [MasterWrController::class, 'delete']);
    Route::get('master-wr/cetak', [MasterWrController::class, 'cetak'])->name("master-wr.cetak");
    Route::post('master-wr/save-data', [MasterWrController::class, 'save']);
    Route::view('/master-wr', 'm-wr')->name('master-wr');
    Route::get('penetapan-wr', [PenetapanWrController::class, 'index']);
    Route::get('penetapan-wr/data', [PenetapanWrController::class, 'getData']);
    Route::get('penetapan-wr/daftar-wr', [PenetapanWrController::class, 'getDataWr']);
    Route::get('penetapan-wr/data-byId', [PenetapanWrController::class, 'getDataById']);
    Route::get('penetapan-wr/max-kode', [PenetapanWrController::class, 'getMaxKode']);
    Route::get('penetapan-wr/data-kecamatan', [PenetapanWrController::class, 'getDataKecamatan']);
    Route::get('penetapan-wr/data-kelurahan', [PenetapanWrController::class, 'getDataKelurahan']);
    Route::get('penetapan-wr/data-tarif', [PenetapanWrController::class, 'getDataTarif']);
    Route::get('penetapan-wr/data-rw', [PenetapanWrController::class, 'getDataRw']);
    Route::get('penetapan-wr/data-rt', [PenetapanWrController::class, 'getDataRt']);
    Route::post('penetapan-wr/save-data', [PenetapanWrController::class, 'save']);
    Route::get('/penetapan-wr/cetak_all', [PenetapanWrController::class, 'cetakAll'])->name('penetapan-wr.cetak_all');
    Route::get('penetapan-wr/get-available-months', [PenetapanWrController::class, 'getAvailableMonths']);
    Route::get('master-rt', [MasterRtController::class, 'index']);
    Route::get('master-rt/data', [MasterRtController::class, 'getData']);
    Route::get('master-rt/data-kecamatan', [MasterRtController::class, 'getDataKecamatan']);
    Route::get('master-rt/data-kelurahan', [MasterRtController::class, 'getDataKelurahan']);
    Route::get('master-rt/data-rw', [MasterRtController::class, 'getDataRw']);
    Route::post('master-rt/save-data', [MasterRtController::class, 'save']);
    Route::view('/master-rt', 'm-rt')->name('master-rt'); 
    Route::get('pembayaran', [PembayaranController::class, 'index']);
    Route::get('pembayaran/data', [PembayaranController::class, 'getData']);
    Route::get('pembayaran/dataDet', [PembayaranController::class, 'getDataDet']);
    Route::get('pembayaran/dataById', [PembayaranController::class, 'dataById']);
    Route::post('pembayaran/save-data', [PembayaranController::class, 'save']);
    Route::post('pembayaran/delete-data', [PembayaranController::class, 'delete']);
    Route::view('/pembayaran', 'pembayaran')->name('pembayaran');
    Route::get('/pembayaran/cetak_stbp', [PembayaranController::class, 'cetakStbp'])->name('pembayaran.cetak_stbp');
    Route::get('pembayaran/autocomplete-npwr', [PembayaranController::class, 'autocomplete']);
    Route::get('master-user', [UserController::class, 'index'])->name('master-user');
    Route::get('master-user/data', [UserController::class, 'getData'])->name('master-user.data');
    Route::post('master-user/save', [UserController::class, 'save'])->name('master-user.save');
    Route::get('master-user/data-byId', [UserController::class, 'getDataById'])->name('master-user.data-byId');
    Route::post('master-user/delete', [UserController::class, 'delete'])->name('master-user.delete');
    Route::get('master-user/data-role', [UserController::class, 'dataRole']);
    Route::get('master-user/data-kecamatan', [UserController::class, 'getDataKecamatan']);
    Route::get('master-menu', [MenuController::class, 'index'])->name('master-menu');
    Route::get('master-menu/data', [MenuController::class, 'getData'])->name('master-menu.data');
    Route::post('master-menu/save', [MenuController::class, 'save'])->name('master-menu.save');
    Route::get('master-menu/data-byId', [MenuController::class, 'getDataById'])->name('master-menu.data-byId');
    Route::get('master-menu/delete', [MenuController::class, 'delete'])->name('master-menu.delete');
    Route::get('master-menu/parent-menu', [MenuController::class, 'getParentMenu'])->name('master-menu.parent-menu');
    Route::post('master-menu/save-user-menu', [MenuController::class, 'saveUserMenu'])->name('master-menu.save-user-menu');
    Route::get('master-menu/get-user-menu', [MenuController::class, 'getUserMenu'])->name('master-menu.get-user-menu');
    Route::get('master-role', [RoleController::class, 'index'])->name('master-role');
    Route::get('master-role/data', [RoleController::class, 'getData'])->name('master-role.data');
    Route::post('master-role/save', [RoleController::class, 'save'])->name('master-role.save');
    Route::get('master-role/data-byId', [RoleController::class, 'getDataById'])->name('master-role.data-byId');
    Route::post('master-role/delete', [RoleController::class, 'delete'])->name('master-role.delete');
    Route::get('master-role/get-menu', [RoleController::class, 'getMenu'])->name('master-role.get-menu');
    Route::get('master-role/get-role-menu', [RoleController::class, 'getRoleMenu'])->name('master-role.get-role-menu');
    Route::post('master-role/save-role-menu', [RoleController::class, 'saveRoleMenu'])->name('master-role.save-role-menu');
    Route::get('pimpinan-kecamatan', [PimpinanKecamatanController::class, 'index'])->name('pimpinan-kecamatan');
    Route::get('pimpinan-kecamatan/data', [PimpinanKecamatanController::class, 'getData'])->name('pimpinan-kecamatan.data');
    Route::post('pimpinan-kecamatan/save', [PimpinanKecamatanController::class, 'save'])->name('pimpinan-kecamatan.save');
    Route::get('pimpinan-kecamatan/data-byId', [PimpinanKecamatanController::class, 'getDataById'])->name('pimpinan-kecamatan.data-byId');
    Route::post('pimpinan-kecamatan/delete', [PimpinanKecamatanController::class, 'delete'])->name('pimpinan-kecamatan.delete');
    Route::get('master-kolektor', [App\Http\Controllers\MasterKolektorController::class, 'index']);
    Route::get('master-kolektor/data', [App\Http\Controllers\MasterKolektorController::class, 'getData']);
    Route::get('master-kolektor/daftar-kolektor', [App\Http\Controllers\MasterKolektorController::class, 'getDataKolektor']);
    Route::get('master-kolektor/data-kecamatan', [App\Http\Controllers\MasterKolektorController::class, 'getDataKecamatan']);
    Route::get('master-kolektor/data-kelurahan', [App\Http\Controllers\MasterKolektorController::class, 'getDataKelurahan']);
    Route::post('master-kolektor/save-data', [App\Http\Controllers\MasterKolektorController::class, 'save']);
    Route::post('master-kolektor/update-status', [App\Http\Controllers\MasterKolektorController::class, 'updateStatus']);
    Route::view('/master-kolektor', 'm-kolektor')->name('master-kolektor');
});
