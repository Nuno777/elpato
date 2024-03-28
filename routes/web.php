<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Worker;
use App\Http\Controllers\DropController;

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
    Route::delete('/drops{drop}', [DropController::class, 'destroy'])->name('drops.destroy');

    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
