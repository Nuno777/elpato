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
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OrderRefController;

Route::get('/', [PageController::class, 'index'])->name('auth.login');
Route::post('/telegram-webhook', [TelegramBotController::class, 'handle']);


//route auth
Route::middleware(['auth', 'verified'])->group(function () {

    //perms admin
    Route::middleware(['admin', Admin::class])->group(function () {
        Route::get('/panel-dashboard', [PageController::class, 'adminpainel'])->name('adminpainel');

        Route::get('/drops', [DropController::class, 'create'])->name('createdrops');
        Route::post('/drops', [DropController::class, 'store'])->name('createdrops.store');
        Route::get('/drops-{slug}-edit', [DropController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('editdrops.edit');
        Route::put('/drops-{slug}', [DropController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('drops.update');
        Route::delete('/drops/{slug}', [DropController::class, 'destroy'])->name('drops.destroy');

        Route::get('/order-status-{slug}-edit', [OrderController::class, 'statusedit'])->where('slug', '[a-zA-Z0-9-]+')->name('editorderstatus.edit');
        Route::put('/order-status/{slug}', [OrderController::class, 'statusupdate'])->where('slug', '[a-zA-Z0-9-]+')->name('orderstatus.update');
        Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/all-orders', [OrderController::class, 'allshow'])->name('orders.all');
        Route::get('/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');

        //restore order
        Route::put('/orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::get('/orders-softdeleted', [OrderController::class, 'allShowDeleted'])->name('orders.deleted');
        Route::delete('/orders/{id}/force-delete', [OrderController::class, 'forceDelete'])->name('orders.forceDelete');

        Route::get('/all-ftid', [ftidController::class, 'allshow'])->name('ftid.all');
        Route::get('/ftid/filter', [ftidController::class, 'filterFTID'])->name('ftid.filter');
        Route::get('/ftid-status-{id}-edit', [ftidController::class, 'statusedit'])->name('editftidstatus.edit');
        Route::put('/ftid-status/{id}', [ftidController::class, 'statusupdate'])->name('ftidstatus.update');

        Route::get('/create-user', [UserController::class, 'index'])->name('createuser');
        Route::get('/create-user', [UserController::class, 'create'])->name('createuser');
        Route::post('/create-user', [UserController::class, 'store'])->name('createuser.store');
        Route::get('/user-{slug}-edit', [UserController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('edituser.edit');
        Route::put('/user/{slug}', [UserController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('user.update');
        Route::get('/all-users', [UserController::class, 'allshow'])->name('user.all');
        Route::delete('/user/{slug}', [UserController::class, 'destroy'])->where('slug', '[a-zA-Z0-9-]+')->name('user.destroy');
        Route::get('/user/filter', [UserController::class, 'filterUser'])->name('user.filter');
        Route::post('/user-{slug}-set-default-password', [UserController::class, 'setDefaultPassword'])->where('slug', '[a-zA-Z0-9-]+')->name('user.setDefaultPassword');

        //restore users
        Route::put('/user/{slug}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::get('/user-softdeleted', [UserController::class, 'allShowDeleted'])->name('user.deleted');
        Route::delete('/user/{slug}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');

        Route::get('/users-orders-{slug}', [OrderController::class, 'showUserOrders'])->where('slug', '[a-zA-Z0-9-]+')->name('user.orders');
        Route::get('/users-ftids-{id}', [ftidController::class, 'showUserFtids'])->name('user.ftids');
        Route::get('/users-drops-{slug}', [DropController::class, 'showUserDrops'])->where('slug', '[a-zA-Z0-9-]+')->name('user.drops');

        Route::post('/assign-drop-to-worker', [DropController::class, 'assignDropToWorker'])->name('assign.worker.drop');
        Route::post('/remove-drop-to-worker', [DropController::class, 'removeDropToWorker'])->name('remove.drop.worker');

        Route::get('/show-messages-all', [MessageController::class, 'show'])->name('showMessageAll');
        Route::get('/show-messages/{Id}', [MessageController::class, 'showMessageUser'])->name('showUserMessage');
        Route::get('messages-{message}-edit', [MessageController::class, 'edit'])->name('messages.edit');
        Route::put('messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::post('/send-message', [TelegramBotController::class, 'sendMessage'])->name('sendMessage');
        Route::get('/send-message-form', [TelegramBotController::class, 'showSendMessageForm'])->name('sendMessage.telegram');

        //logs
        Route::get('/login-logs', [LogController::class, 'loginLogs'])->name('login.logs');
        Route::get('/users-logs', [LogController::class, 'usersLogs'])->name('users.logs');
        Route::get('/orders-logs', [LogController::class, 'ordersLogs'])->name('orders.logs');

        //refs
        Route::get('/orders-refund', [OrderRefController::class, 'index'])->name('orders.ref');
        Route::get('/orders/create', [OrderRefController::class, 'create'])->name('orders.create');
        Route::post('/orders-refund', [OrderRefController::class, 'store'])->name('ordersRef.store');
    });

    //perms admin or general
    Route::middleware(['admin.or.general', AdminOrGeneral::class])->group(function () {

        Route::get('/ftid', [ftidController::class, 'index'])->name('ftid');
        Route::get('/create-ftid', [ftidController::class, 'create'])->name('createftid');
        Route::post('/create-ftid', [ftidController::class, 'store'])->name('ftid.store');
        Route::get('/ftid-{id}-edit', [ftidController::class, 'edit'])->name('editftid.edit');
        Route::put('/ftid/{id}', [ftidController::class, 'update'])->name('ftid.update');
        Route::delete('/ftids/{id}', [ftidController::class, 'destroy'])->name('ftid.destroy');
    });

    //perms admin or general or worker
    Route::middleware(['access.drop.order', AccessDropsOrOrders::class])->group(function () {
        Route::get('/main-panel', [PageController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile-settings', [UserController::class, 'accountSettings'])->name('profile.settings');
        Route::post('/account-settings', [UserController::class, 'changePassword'])->name('account.change.password');

        Route::get('/drops', [DropController::class, 'index'])->name('drops');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('createorder');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/order-{slug}-edit', [OrderController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('editorder.edit');
        Route::put('/order/{slug}', [OrderController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('order.update');
        Route::delete('/orders/{slug}', [OrderController::class, 'destroy'])->where('slug', '[a-zA-Z0-9-]+')->name('orders.destroy');

        Route::get('/message/create', [MessageController::class, 'create'])->name('createmessage');
        Route::post('/drops-send-request/{id_drop}', [MessageController::class, 'sendRequest'])->name('sendDropRequest');
    });
});

require __DIR__ . '/auth.php';
