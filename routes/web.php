<?php

use App\Http\Controllers\Authetenticate\LoginController;
use App\Http\Controllers\Authetenticate\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::get('/{reference}/show', [OrderController::class, 'show'])->name('show');
        Route::get('/{reference}/print', [OrderController::class, 'print'])->name('print');
    });

    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
    });

    Route::prefix('income')->name('income.')->group(function () {
        Route::get('/', [IncomeController::class, 'index'])->name('index');
    });
});
