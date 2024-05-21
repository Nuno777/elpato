<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AdminOrGeneral;
use App\Http\Middleware\AccessDropsOrOrders;
use App\Http\Controllers\DropController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ftidController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MessageController;

Route::get('/', [PageController::class, 'index'])->name('auth.login');

//route auth
Route::middleware(['auth', 'verified'])->group(function () {

    //perms admin
    Route::middleware(['admin', Admin::class])->group(function () {
        Route::get('/adminpainel', [PageController::class, 'adminpainel'])->name('adminpainel');

        Route::get('/createdrops', [DropController::class, 'create'])->name('createdrops');
        Route::post('/createdrops', [DropController::class, 'store'])->name('createdrops.store');
        Route::get('/editdrops-{id}-edit', [DropController::class, 'edit'])->name('editdrops.edit');
        Route::put('/drops/{id}', [DropController::class, 'update'])->name('drops.update');
        Route::delete('/drops/{drop}', [DropController::class, 'destroy'])->name('drops.destroy');

        Route::get('/editorderstatus/{id}/edit', [OrderController::class, 'statusedit'])->name('editorderstatus.edit');
        Route::put('/orderstatus/{id}', [OrderController::class, 'statusupdate'])->name('orderstatus.update');
        Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/allorders', [OrderController::class, 'allshow'])->name('orders.all');
        Route::get('/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');

        Route::get('/allftid', [ftidController::class, 'allshow'])->name('ftid.all');
        Route::get('/ftid/filter', [ftidController::class, 'filterFTID'])->name('ftid.filter');
        Route::get('/ftid-{id}-editstatus', [ftidController::class, 'statusedit'])->name('editftidstatus.edit');
        Route::put('/ftidstatus/{id}', [ftidController::class, 'statusupdate'])->name('ftidstatus.update');

        Route::get('/createuser', [UserController::class, 'index'])->name('createuser');
        Route::get('/createuser', [UserController::class, 'create'])->name('createuser');
        Route::post('/createuser', [UserController::class, 'store'])->name('createuser.store');
        Route::get('/edituser-{id}-edit', [UserController::class, 'edit'])->name('edituser.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/allusers', [UserController::class, 'allshow'])->name('user.all');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/filter', [UserController::class, 'filterUser'])->name('user.filter');
        Route::post('/user-{id}-set-default-password', [UserController::class, 'setDefaultPassword'])->name('user.setDefaultPassword');

        Route::get('/usersorders{id}', [OrderController::class, 'showUserOrders'])->name('user.orders');
        Route::get('/usersftids{id}', [ftidController::class, 'showUserFtids'])->name('user.ftids');
        Route::get('/usersdrops{id}', [DropController::class, 'showUserDrops'])->name('user.drops');

        Route::post('/assign-drop-to-worker', [DropController::class, 'assignDropToWorker'])->name('assign.worker.drop');
        Route::post('/remove-drop-to-worker', [DropController::class, 'removeDropToWorker'])->name('remove.drop.worker');

        Route::get('/show-messages-all', [MessageController::class, 'show'])->name('showMessageAll');
        Route::get('/show-messages/{Id}', [MessageController::class, 'showMessageUser'])->name('showUserMessage');
        Route::get('messages-{message}-edit', [MessageController::class, 'edit'])->name('messages.edit');
        Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

        //logs
        Route::get('/login-logs', [App\Http\Controllers\LogController::class, 'loginLogs'])->name('login.logs');

    });

    //perms admin or general
    Route::middleware(['admin.or.general', AdminOrGeneral::class])->group(function () {

        Route::get('/ftid', [ftidController::class, 'index'])->name('ftid');
        Route::get('/createftid', [ftidController::class, 'create'])->name('createftid');
        Route::post('/createftid', [ftidController::class, 'store'])->name('ftid.store');
        Route::get('/ftid-{id}-edit', [ftidController::class, 'edit'])->name('editftid.edit');
        Route::put('/ftid/{id}', [ftidController::class, 'update'])->name('ftid.update');
        Route::delete('/ftids/{id}', [ftidController::class, 'destroy'])->name('ftid.destroy');
    });

    //perms admin or general or worker
    Route::middleware(['access.drop.order', AccessDropsOrOrders::class])->group(function () {
        Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile-settings', [UserController::class, 'accountSettings'])->name('profile.settings');
        Route::post('/account-settings', [UserController::class, 'changePassword'])->name('account.change.password');

        Route::get('/drops', [DropController::class, 'index'])->name('drops');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('createorder');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/editorder-{id}-edit', [OrderController::class, 'edit'])->name('editorder.edit');
        Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

        Route::get('/message/create', [MessageController::class, 'create'])->name('createmessage');
        Route::post('/drops/send-request/{id_drop}', [MessageController::class, 'sendRequest'])->name('sendDropRequest');
    });
});

require __DIR__ . '/auth.php';
