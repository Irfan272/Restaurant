<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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

// Login

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('showlogin');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

// Akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index']);
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create']);
Route::post('/akun/store', [App\Http\Controllers\AkunController::class, 'store']);
Route::get('/akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit']);
Route::patch('/akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update']);
Route::delete('/akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete']);

// Category
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create']);
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::patch('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::delete('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);

// Menu
Route::get('/list-menu', [MenuController::class, 'index']);
Route::get('/list-menu/create', [App\Http\Controllers\MenuController::class, 'create']);
Route::post('/list-menu/store', [App\Http\Controllers\MenuController::class, 'store']);
Route::get('/list-menu/edit/{id}', [App\Http\Controllers\MenuController::class, 'edit']);
Route::patch('/list-menu/update/{id}', [App\Http\Controllers\MenuController::class, 'update']);
Route::delete('/list-menu/delete/{id}', [App\Http\Controllers\MenuController::class, 'delete']);


// Pesanan
Route::get('/pesanan', [App\Http\Controllers\PesananController::class, 'index']);
Route::get('/pesanan/edit/{id}', [App\Http\Controllers\PesananController::class, 'edit']);
Route::patch('/pesanan/update/{id}', [App\Http\Controllers\PesananController::class, 'update']);
Route::get('/pesanan/view/{id}', [App\Http\Controllers\PesananController::class, 'view']);

// Rating
Route::get('/rating', [App\Http\Controllers\RatingController::class, 'index']);
Route::get('/rating/create', [App\Http\Controllers\RatingController::class, 'create']);
Route::post('/rating/store', [App\Http\Controllers\RatingController::class, 'store']);


// Customer Makanan
Route::get('/makanan', [App\Http\Controllers\MakananController::class, 'index']);
Route::get('/makanan/detail/{id}', [App\Http\Controllers\MakananController::class, 'detail']);

// Customer Minuman
Route::get('/minuman', [App\Http\Controllers\MinumanController::class, 'index']);
Route::get('/minuman/detail/{id}', [App\Http\Controllers\MinumanController::class, 'detail']);

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/tambah/{id}', [OrderController::class, 'tambah'])->name('order.tambah');
Route::get('/order/hapus/{id}', [OrderController::class, 'hapus'])->name('order.hapus');
Route::get('/order/reset', [OrderController::class, 'reset'])->name('order.reset');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/proses-checkout', [OrderController::class, 'prosesCheckout'])->name('proses.checkout');

// Laporan Penjualan
Route::get('/laporan-penjualan', [App\Http\Controllers\LaporanController::class, 'index']);
Route::get('/cetak-laporan-penjualan/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\LaporanController::class, 'printPenjualan']);

Route::get('/get-penjualan-data', [App\Http\Controllers\LaporanController::class, 'getPengirimanData']);

