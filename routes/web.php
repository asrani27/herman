<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuperadminController;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', function(){
    return redirect('/');
})->name('login');


Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/superadmin/home', [SuperadminController::class, 'home']);
    Route::get('/superadmin/profil', [SuperadminController::class, 'profil']);
    Route::post('/superadmin/profil', [SuperadminController::class, 'changeSuperadmin']);

    Route::get('/superadmin/skpd', [SuperadminController::class, 'skpd']);
    Route::get('/superadmin/skpd/add', [SuperadminController::class, 'addSkpd']);
    Route::post('/superadmin/skpd/add', [SuperadminController::class, 'storeSkpd']);
    Route::get('/superadmin/skpd/edit/{id}', [SuperadminController::class, 'editSkpd']);
    Route::post('/superadmin/skpd/edit/{id}', [SuperadminController::class, 'updateSkpd']);
    Route::get('/superadmin/skpd/delete/{id}', [SuperadminController::class, 'deleteSkpd']);
    
    Route::get('/superadmin/pegawai', [SuperadminController::class, 'pegawai']);
    Route::get('/superadmin/pegawai/add', [SuperadminController::class, 'addPegawai']);
    Route::post('/superadmin/pegawai/add', [SuperadminController::class, 'storePegawai']);
    Route::get('/superadmin/pegawai/edit/{id}', [SuperadminController::class, 'editPegawai']);
    Route::post('/superadmin/pegawai/edit/{id}', [SuperadminController::class, 'updatePegawai']);
    Route::get('/superadmin/pegawai/delete/{id}', [SuperadminController::class, 'deletePegawai']);
    
    Route::get('/superadmin/setting/kategori/upload', [SuperadminController::class, 'kategori']);
    Route::get('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'addKategori']);
    Route::post('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'storeKategori']);
    Route::get('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'editKategori']);
    Route::post('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'updateKategori']);
    Route::get('/superadmin/setting/kategori/upload/delete/{id}', [SuperadminController::class, 'deleteKategori']);
});


Route::group(['middleware' => ['auth', 'role:pegawai']], function () {
    Route::get('/pegawai/home', [PegawaiController::class, 'home']);    
});