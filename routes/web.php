<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Worker;
use App\Http\Controllers\DropController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ftidController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Models\Order;

Route::get('/', function () {
    return view('auth.login');
});

//Route::post('/login', [LoginController::class, 'login'])->name('login');

//Routes lvl 5, Admin
Route::middleware(['auth', 'verified', 'admin', Admin::class])->group(function () {

    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
    Route::get('/adminpainel', [PageController::class, 'adminpainel'])->name('adminpainel');

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
    Route::get('/allorders', [OrderController::class, 'allshow'])->name('orders.all');
    Route::get('/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');

    Route::get('/ftid/{id}/edit', [ftidController::class, 'edit'])->name('editftid.edit');
    Route::put('/ftid/{id}', [ftidController::class, 'update'])->name('ftid.update');
    Route::get('/allftid', [ftidController::class, 'allshow'])->name('ftid.all');
    Route::get('/ftid/filter', [ftidController::class, 'filterFTID'])->name('ftid.filter');

    Route::get('/createuser', [UserController::class, 'index'])->name('createuser');
    Route::get('/createuser', [UserController::class, 'create'])->name('createuser');
    Route::post('/createuser', [UserController::class, 'store'])->name('createuser.store');
    Route::get('/edituser/{id}/edit', [UserController::class, 'edit'])->name('edituser.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/allusers', [UserController::class, 'allshow'])->name('user.all');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/filter', [UserController::class, 'filterUser'])->name('user.filter');
});


//Routes lvl 0, User
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/drops', [DropController::class, 'index'])->name('drops');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('createorder');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/ftid', [ftidController::class, 'index'])->name('ftid');
    Route::get('/ftid/create', [ftidController::class, 'create'])->name('createftid');
    Route::post('/ftid/create', [ftidController::class, 'store'])->name('ftid.store');
    Route::delete('/ftids/{id}', [ftidController::class, 'destroy'])->name('ftid.destroy');
});


Route::middleware('auth', 'admin')->group(function () {

    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
