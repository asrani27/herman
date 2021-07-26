<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuperadminController;

Route::get('/', [LoginController::class, 'index']);
//Route::get('/', [ContohController::class, 'index']);
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
    Route::get('/superadmin/download', [SuperadminController::class, 'download']);
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
    Route::get('/superadmin/pegawai/createuser/{id}', [SuperadminController::class, 'createuser']);
    Route::get('/superadmin/pegawai/createuser', [SuperadminController::class, 'createalluser']);
    Route::get('/superadmin/pegawai/resetpass/{id}', [SuperadminController::class, 'resetpass']);
    Route::get('/superadmin/pegawai/import', [SuperadminController::class, 'import']);
    Route::post('/superadmin/pegawai/import', [SuperadminController::class, 'storeImport']);
    Route::get('/superadmin/pegawai/search', [SuperadminController::class, 'searchPegawai']);
    
    Route::get('/superadmin/setting/kategori/upload', [SuperadminController::class, 'kategori']);
    Route::get('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'addKategori']);
    Route::post('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'storeKategori']);
    Route::get('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'editKategori']);
    Route::post('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'updateKategori']);
    Route::get('/superadmin/setting/kategori/upload/delete/{id}', [SuperadminController::class, 'deleteKategori']);
});


Route::group(['middleware' => ['auth', 'role:pegawai']], function () {
    Route::get('/pegawai/home', [PegawaiController::class, 'home']);  
    Route::get('/pegawai/profil', [PegawaiController::class, 'profil']);    
    Route::post('/pegawai/profil', [PegawaiController::class, 'changePegawai']);  
    
    Route::get('/pegawai/upload', [PegawaiController::class, 'upload']);      
    Route::get('/pegawai/upload/add/{kategori_id}', [PegawaiController::class, 'addUpload']); 
    Route::post('/pegawai/upload/add/{kategori_id}', [PegawaiController::class, 'storeUpload']);     
    Route::get('/pegawai/upload/delete/{id}', [PegawaiController::class, 'deleteFile']);         
    Route::get('/pegawai/view/{nip}/{filename}', [PegawaiController::class, 'viewFile']);       
});