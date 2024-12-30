<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PermohonanPelayananController;
use App\Http\Controllers\QuisionerController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Rute admin dengan prefix 'admin'
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/signin', [AdminAuthController::class, 'showLoginForm'])->name('admin.signin');
    Route::post('/signin', [AdminAuthController::class, 'loginAdmin'])->name('admin.login.submit');
});

Route::get('/login', [UserAuthController::class, 'loginFrom'])->name('login');
Route::post('/login', [UserAuthController::class, 'loginAction'])->name('login.action');

Route::get('/register', [UserAuthController::class, 'RegisForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'RegisAction'])->name('register.action');


// Rute admin dengan middleware 'auth:admin' 
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/SPTPD', [PermohonanPelayananController::class, 'index'])->name('admin.sptpd');
    // Ubah menjadi POST
    Route::post('/SPTPD/{id}/validate', [PermohonanPelayananController::class, 'validatePermohonan'])->name('admin.permohonan.validate');



    Route::post('/logout_admin', [AdminAuthController::class, 'Adminlogout'])->name('admin.logout');

    Route::resource('kelola_admin', AdminController::class);
    Route::resource('kelola_user', UserController::class);
});


// Rute untuk user dengan middleware 'auth' untuk memastikan user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/', [UserAuthController::class, 'home'])->name('home');
    Route::get('/pelayanan', [UserAuthController::class, 'pelayanan'])->name('pelayanan');

    Route::resource('quisioner', QuisionerController::class);

    Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [UserController::class, 'processChangePassword']);
    Route::get('/permohonan/create', [PermohonanPelayananController::class, 'create'])->name('permohonan.create');
    Route::post('/permohonan', [PermohonanPelayananController::class, 'store'])->name('permohonan.store');
    Route::get('/permohonan', [PermohonanPelayananController::class, 'index'])->name('permohonan.index');
    Route::post('/permohonan/{id}/validate', [PermohonanPelayananController::class, 'validatePermohonan'])->name('permohonan.validate');
    Route::get('/detail-permohonan/{id}', [PermohonanPelayananController::class, 'detailPermohonan'])->name('detail-permohonan');

    // Logout user
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::get('/analisis_quisioner', function () {
    return view('analisis_quisioner');
});
