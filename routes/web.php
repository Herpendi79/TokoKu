<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Models\TransaksiModel;

Route::get('admin/produk/tampil-produk', [
    ProdukController::class,
    'index',
])->name('produk.index');
Route::get('admin/tambah-produk', [ProdukController::class, 'create'])->name(
    'produk.create',
);
Route::post('/simpan-produk', [ProdukController::class, 'store'])->name(
    'produk.store',
);
Route::get('admin/edit-produk/{id}', [ProdukController::class, 'edit'])->name(
    'produk.edit',
);
Route::put('/update-produk/{id}', [ProdukController::class, 'update'])->name(
    'produk.update',
);
Route::delete('/hapus-produk/{id}', [ProdukController::class, 'destroy'])->name(
    'produk.destroy',
);
Route::get('admin/detil-produk/{id}', [ProdukController::class, 'show'])->name(
    'produk.show',
);
Route::get('admin/export-produk', [ProdukController::class, 'export'])->name(
    'produk.export',
);

Route::get('/', [ProdukController::class, 'katalog'])->name('katalog');

#user
Route::get('user/produk/tampil-produk', [
    ProdukController::class,
    'katalog_user',
])->name('produk.katalog');

Route::get('user/detil-produk/{id}', [
    ProdukController::class,
    'show_user',
])->name('produk.show');

Route::post('/store', [ProdukController::class, 'store_user'])->name(
    'transaksi.store_user',
);

Route::get('/User_page/produk/pembayaran/{snapToken}', function ($snapToken) {
    $transaksi = TransaksiModel::where('snap_token', $snapToken)->first();
    return view('User_page.produk.pembayaran', [
        'snapToken' => $snapToken,
        'price' => $transaksi?->price ?? 0,
        'status' => $transaksi?->status ?? '-',
    ]);
})->name('user.produk.pembayaran');

Route::get('user/produk/history', [
    ProdukController::class,
    'history',
])->name('produk.history');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/cek_login', [AuthController::class, 'cek_login'])->name(
    'cek_login',
);
Route::get('/register-form', [AuthController::class, 'registerForm'])->name(
    'registerForm',
);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/admin/dashboard', function () {
    return view('Admin_page.Main.dashboard');
})->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('User_page.Main.dashboard');
})->name('user.dashboard');

Route::get('/forget-password', [AuthController::class, 'lupaPassword'])->name(
    'lupaPassword',
);

Route::post('/resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('auth.google');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);
