<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;

Route::get('admin/produk/tampil-produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/tambah-produk', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/simpan-produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/edit-produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/update-produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/hapus-produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/detil-produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('admin/export-produk', [ProdukController::class, 'export'])->name('produk.export');

Route::get('/', [ProdukController::class, 'katalog'])->name('katalog');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/cek_login', [AuthController::class, 'cek_login'])->name('cek_login');
Route::get('/register-form', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/admin/dashboard', function () {
    return view('Admin_page.Main.dashboard');
})->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('User_page.Main.dashboard');
})->name('user.dashboard');
