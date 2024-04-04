<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Worker;
use App\Http\Controllers\DropController;
use App\Http\Controllers\OrderController;
use App\Models\Order;

Route::get('/', function () {
    return view('auth.login');
});

//Route::post('/login', [LoginController::class, 'login'])->name('login');

//Routes lvl 5, Admin
Route::middleware(['auth', 'verified', 'admin', Admin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/drops', [DropController::class, 'index'])->name('drops');
    Route::get('/createdrops', [DropController::class, 'create'])->name('createdrops');
    Route::post('/createdrops', [DropController::class, 'store'])->name('createdrops.store');
    Route::get('/editdrops/{id}/edit', [DropController::class, 'edit'])->name('editdrops.edit');
    Route::put('/drops/{id}', [DropController::class, 'update'])->name('drops.update');
    Route::delete('/drops/{drop}', [DropController::class, 'destroy'])->name('drops.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('createorder');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    //Route::get('/orders/all', [OrderController::class, 'allshow'])->name('orders.all');
});


//Routes lvl 0, User
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/drops', [DropController::class, 'index'])->name('drops');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('createorder');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});


Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
