<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;


Route::get('/unauthorize', function() {
    return view('auth.unathorize');
})->name('unauthorized-page');

// auth login
Route::middleware('guest')->group(function(){
    Route::get('/login',[LoginController::class,'login'])->name('login');
    Route::post('/login',[LoginController::class,'doLogin'])->name('doLogin');
});

Route::get('/logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');
Route::middleware('role:superadmin,admin')->group(function(){
    Route::get('/internal', [DashboardController::class, 'index'])
        ->name('dashboard');
    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])
        ->name('karyawan.index');
    Route::get('/karyawan/data', [KaryawanController::class, 'data'])
        ->name('karyawan.data');
    Route::get('/karyawan/add', [KaryawanController::class, 'create'])
        ->name('karyawan.create');
    Route::post('/karyawan/simpan', [KaryawanController::class, 'store'])
        ->name('karyawan.store');
    Route::get('/karyawan/detail/{id}', [KaryawanController::class, 'detail'])
        ->name('karyawan.detail');
    Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])
        ->name('karyawan.edit');
    Route::post('/karyawan/update', [KaryawanController::class, 'update'])
        ->name('karyawan.update');
    Route::post('/karyawan/hapus', [KaryawanController::class, 'hapus'])
        ->name('karyawan.hapus');

    });

Route::middleware('role:superadmin')->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
    Route::post('/user/store',[UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'userId'])->name('user.id');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
});
