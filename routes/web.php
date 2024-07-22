<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\AdminSabaController;
use App\Http\Controllers\Dashboard\InvoiceController;
use App\Http\Controllers\Dashboard\KamarController;
use App\Http\Controllers\Dashboard\PdfController;
use App\Http\Controllers\Dashboard\PembayaranController;
use App\Http\Controllers\Dashboard\Saba\AsalSekolahController;
use App\Http\Controllers\Dashboard\Saba\BerkasController;
use App\Http\Controllers\Dashboard\Saba\OrtuController;
use App\Http\Controllers\Dashboard\Saba\SabaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Route;


Route::get('/unauthorize', function() {
    return view('auth.unathorize');
})->name('unauthorized-page');
Route::get('/',[HomeController::class,'index'])->name('home')->middleware('throttle:home');
// auth register
Route::middleware('guest','throttle:register')->group(function(){
    Route::get('/register-saba',[RegisterController::class,'register'])->name('register');
    Route::post('/register-saba',[RegisterController::class,'doRegister'])->name('doRegister');
});
// auth login
Route::middleware('guest','throttle:login')->group(function(){
    Route::get('/login',[LoginController::class,'login'])->name('login');
    Route::post('/login',[LoginController::class,'doLogin'])->name('doLogin');
});
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
// dashboard saba
Route::middleware('role:saba','throttle:saba')->group(function(){
    // dashboard saba
    Route::get('/dashba',[SabaController::class,'index'])->name('dashba');
    Route::get('/data-diri',[SabaController::class,'data_diri'])->name('data-diri');
    Route::post('/data-diri/{id}',[SabaController::class,'updateDataDiri'])->name('upadateDataDiri');
    Route::get('/data-ortu', [OrtuController::class, 'index'])->name('dataOrtu');
    Route::post('/data-ortu/{id}',[OrtuController::class, 'updateOrtu'])->name('updateOrtu');
    Route::get('/asal-sekolah', [AsalSekolahController::class, 'index'])->name('asalSekolah');
    Route::post('/asal-sekolah/{id}',[AsalSekolahController::class,'updateAsalSekolah'])->name( 'updateAsalSekolah');
    Route::get('/berkas-saba', [BerkasController::class,'index'])->name('sabaBerkas');
    Route::post('/berkas-saba/{id}', [BerkasController::class, 'updateBerkas'])->name('updateBerkas');
});
// dashboard admin
Route::middleware('role:admin', 'throttle:admin')->group(function(){
    // dashboard
    Route::get('/dashmin',[AdminController::class, 'index'])->name('dashmin');
    // settings----------------------------------------------------------------------------------------------------------
    // setting jenis pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/data-pembayaran', [PembayaranController::class, 'get_all']);
    Route::get('/id-pembayaran/{id}', [PembayaranController::class, 'getById']);
    Route::post('/update-pembayaran', [PembayaranController::class, 'update_pembayaran']);
    Route::delete('/delete-pembayaran/{id}', [PembayaranController::class, 'deletePembayaran']);
    // setting kamar
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar');
    Route::get('/data-kamar', [KamarController::class, 'getKamar']);
    Route::post('/store-kamar', [KamarController::class, 'store']);
    Route::get('/id-kamar/{id}', [KamarController::class, 'idKamar']);
    Route::post('/update-kamar', [KamarController::class, 'update_kamar']);
    Route::delete('/delete-kamar/{id}', [KamarController::class, 'delete_kamar']);
    Route::post('/set-kamar-santri/{id}', [KamarController::class, 'setKamarSantri']);
    // invoice-----------------------------------------------------------------------------------------------------------
    Route::get('/invoice', [InvoiceController::class, 'indexInvoice'])->name('index.invoice');
    Route::get('/allInvoice', [InvoiceController::class, 'allInvoice']);
    Route::get('/get-pembayaran/{id}', [InvoiceController::class, 'getPembayaranId']);
    Route::post('/store-tagihan-pendaftaran', [InvoiceController::class, 'storeInvoicePendaftaran']);
    Route::get('/set-active-santri/{id}', [InvoiceController::class, 'setActiveSantri']);
    // data santri
    Route::get('/saba-all', [AdminSabaController::class,'index'])->name('data_saba_all');
    Route::get('/getAllSantri', [AdminSabaController::class, 'getAllSantri']);
    Route::get('/create', [AdminSabaController::class, 'create'])->name('create_saba');
    Route::post('/store-santri', [AdminSabaController::class, 'store'])->name('store_santri');
    Route::get('/show-saba/{id}', [AdminSabaController::class, 'showSaba'])->name('showSaba');
    Route::post('/saba/{id}/update', [AdminSabaController::class, 'updateSaba'])->name('updateSaba');
    // cek saudara kandung
    Route::post('/saudara-kandung/{nokk}', [AdminSabaController::class, 'cekSaudaraKandung']);
    Route::post('/updateSaudaraKandung', [AdminSabaController::class, 'updateSaudaraKandung']);
    // berkas
    Route::get('/berkas', [AdminSabaController::class, 'createBerkas'])->name('berkas.index');
    Route::post('/berkas', [AdminSabaController::class, 'store_berkas'])->name('store.berkas');
    // user
    Route::get('/user', [UserController::class, 'santri'])->name('user.index');
    Route::get('/getUserSantri', [UserController::class, 'userSantri']);
    Route::get('/getUserSantriById/{id}', [UserController::class, 'get_santri_by_id']);
    Route::post('/update-password/{uid}', [UserController::class, 'update_password_santri']);
    Route::get('/admin', [UserController::class, 'admin'])->name('admin.index');
    Route::get('/getUserAdmin', [UserController::class, 'userAdmin']);
    Route::post('/store-admin', [UserController::class, 'store_admin']);
    Route::get('/get-id-admin/{uid}', [UserController::class, 'getIdAdmin']);
    Route::post('/update-admin', [UserController::class, 'update_admin']);
    Route::delete('/delete-admin/{uid}', [UserController::class, 'delete_admin']);
    // lihat data diri santri
    Route::get('/lihat-santri/{id}', [AdminSabaController::class, 'lihatSantri']);
    // load berkas
    Route::get('/load-berkas/{sid}', [AdminSabaController::class, 'lihatBerkas']);
    // pdf
    Route::get('/bukti-pendaftaran/{id}', [PdfController::class, 'buktiPendaftaran'])->name('bukti_pendaftaran');
});
// pekerjaan
Route::get('/pekerjaan', [PekerjaanController::class, 'getAll']);
// pendidikan
Route::get('/pendidikan', [PendidikanController::class, 'getAll']);
