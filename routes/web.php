<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TestimoniController;
use App\Http\Middleware\cekLogin;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('galeri', [HomeController::class, 'galeri'])->name('listGaleri');
    Route::get('product', [HomeController::class, 'product'])->name('homeProduct');
    Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detailProduct');
});

Route::prefix('adminMerahAndalanku')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'login'])->name('login');
        Route::post('authLogin', [AuthController::class, 'index'])->name('authLogin');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::get('main', [DashboardController::class, 'index'])->name('mainDashboard');

    Route::prefix('produk')->middleware(cekLogin::class)->group(function () {
        Route::get('/', [ProdukController::class, 'home'])->name('adminProduct');
        Route::get('tambah', [ProdukController::class, 'tambah'])->name('tambahProduk');
        Route::post('proses', [ProdukController::class, 'store'])->name('storeProduk');
        Route::get('edit/{id}', [ProdukController::class, 'edit'])->name('editProduk');
        Route::put('update/{id}', [ProdukController::class, 'update'])->name('updateProduk');
        Route::delete('delete/{id}', [ProdukController::class, 'delete'])->name('deleteProduk');
    });

    Route::prefix('kategori')->middleware(cekLogin::class)->group(function () {
        Route::get('/', [KategoriController::class, 'home'])->name('adminKategori');
        Route::get('tambah', [KategoriController::class, 'tambah'])->name('tambahKategori');
        Route::post('proses', [KategoriController::class, 'store'])->name('storeKategori');
        Route::get('edit/{id}', [KategoriController::class, 'edit'])->name('editKategori');
        Route::put('update/{id}', [KategoriController::class, 'update'])->name('updateKategori');
        Route::delete('delete/{id}', [KategoriController::class, 'delete'])->name('deleteKategori');
    });

    Route::prefix('galeri')->middleware(cekLogin::class)->group(function () {
        Route::get('/', [GaleriController::class, 'home'])->name('adminGaleri');
        Route::get('tambah', [GaleriController::class, 'tambah'])->name('tambahGaleri');
        Route::post('proses', [GaleriController::class, 'store'])->name('storeGaleri');
        Route::get('edit/{id}', [GaleriController::class, 'edit'])->name('editGaleri');
        Route::put('update/{id}', [GaleriController::class, 'update'])->name('updateGaleri');
        Route::delete('delete/{id}', [GaleriController::class, 'delete'])->name('deleteGaleri');
    });

    Route::prefix('testimoni')->middleware(cekLogin::class)->group(function () {
        Route::get('/', [TestimoniController::class, 'home'])->name('adminTestimoni');
        Route::get('tambah', [TestimoniController::class, 'tambah'])->name('tambahTestimoni');
        Route::post('proses', [TestimoniController::class, 'store'])->name('storeTestimoni');
        Route::get('edit/{id}', [TestimoniController::class, 'edit'])->name('editTestimoni');
        Route::put('update/{id}', [TestimoniController::class, 'update'])->name('updateTestimoni');
        Route::delete('delete/{id}', [TestimoniController::class, 'delete'])->name('deleteTestimoni');
    });

    Route::prefix('client')->middleware(cekLogin::class)->group(function () {
        Route::get('/', [ClientController::class, 'home'])->name('adminClient');
        Route::get('tambah', [ClientController::class, 'tambah'])->name('tambahClient');
        Route::post('proses', [ClientController::class, 'store'])->name('storeClient');
        Route::get('edit/{id}', [ClientController::class, 'edit'])->name('editClient');
        Route::put('update/{id}', [ClientController::class, 'update'])->name('updateClient');
        Route::delete('delete/{id}', [ClientController::class, 'delete'])->name('deleteClient');
    });
});
