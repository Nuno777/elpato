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
        Route::get('/panel/dashboard', [PageController::class, 'adminpainel'])->name('adminpainel');

        Route::get('/panel/dashboard/drops', [DropController::class, 'create'])->name('createdrops');
        Route::post('/panel/dashboard/drops', [DropController::class, 'store'])->name('createdrops.store');
        Route::get('/panel/dashboard/drops/{slug}/edit', [DropController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('editdrops.edit');
        Route::put('/panel/dashboard/drops/{slug}', [DropController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('drops.update');
        Route::delete('/panel/dashboard/drops/{slug}', [DropController::class, 'destroy'])->name('drops.destroy');

        Route::get('/panel/dashboard/order/status/{slug}/edit', [OrderController::class, 'statusedit'])->where('slug', '[a-zA-Z0-9-]+')->name('editorderstatus.edit');
        Route::put('/panel/dashboard/order/status/{slug}', [OrderController::class, 'statusupdate'])->where('slug', '[a-zA-Z0-9-]+')->name('orderstatus.update');
        Route::get('/panel/dashboard/orders/show', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/panel/dashboard/all-orders', [OrderController::class, 'allshow'])->name('orders.all');
        Route::get('/panel/dashboard/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');

        //restore order
        Route::put('/panel/dashboard/orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::get('/panel/dashboard/orders-softdeleted', [OrderController::class, 'allShowDeleted'])->name('orders.deleted');
        Route::delete('/panel/dashboard/orders/{slug}/force-delete', [OrderController::class, 'forceDelete'])->where('slug', '[a-zA-Z0-9-]+')->name('orders.forceDelete');

        Route::get('/panel/dashboard/all-ftid', [ftidController::class, 'allshow'])->name('ftid.all');
        Route::get('/panel/dashboard/ftid/filter', [ftidController::class, 'filterFTID'])->name('ftid.filter');
        Route::get('/panel/dashboard/ftid-status-{id}-edit', [ftidController::class, 'statusedit'])->name('editftidstatus.edit');
        Route::put('/panel/dashboard/ftid-status/{id}', [ftidController::class, 'statusupdate'])->name('ftidstatus.update');

        Route::get('/panel/dashboard/create-user', [UserController::class, 'index'])->name('createuser');
        Route::get('/panel/dashboard/create-user', [UserController::class, 'create'])->name('createuser');
        Route::post('/panel/dashboard/create-user', [UserController::class, 'store'])->name('createuser.store');
        Route::get('/panel/dashboard/user-{slug}-edit', [UserController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('edituser.edit');
        Route::put('/panel/dashboard/user/{slug}', [UserController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('user.update');
        Route::get('/panel/dashboard/all-users', [UserController::class, 'allshow'])->name('user.all');
        Route::delete('/panel/dashboard/user/{slug}', [UserController::class, 'destroy'])->where('slug', '[a-zA-Z0-9-]+')->name('user.destroy');
        Route::get('/panel/dashboard/user/filter', [UserController::class, 'filterUser'])->name('user.filter');
        Route::post('/panel/dashboard/user-{slug}-set-default-password', [UserController::class, 'setDefaultPassword'])->where('slug', '[a-zA-Z0-9-]+')->name('user.setDefaultPassword');
        Route::post('/panel/dashboard/validate-password', [UserController::class, 'validatePassword']);

        Route::post('/send-verification-code/{slug}', [UserController::class, 'sendVerificationCode']);
        Route::post('/verify-code/{slug}', [UserController::class, 'verifyCode']);


        //restore users
        Route::put('/panel/dashboard/user/{slug}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::get('/panel/dashboard/user-softdeleted', [UserController::class, 'allShowDeleted'])->name('user.deleted');
        Route::delete('/panel/dashboard/user/{slug}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');

        Route::get('/panel/dashboard/users-orders-{slug}', [OrderController::class, 'showUserOrders'])->where('slug', '[a-zA-Z0-9-]+')->name('user.orders');
        Route::get('/panel/dashboard/users-ftids-{id}', [ftidController::class, 'showUserFtids'])->name('user.ftids');
        Route::get('/panel/dashboard/users-drops-{slug}', [DropController::class, 'showUserDrops'])->where('slug', '[a-zA-Z0-9-]+')->name('user.drops');

        Route::post('/panel/dashboard/assign-drop-to-worker', [DropController::class, 'assignDropToWorker'])->name('assign.worker.drop');
        Route::get('/panel/dashboard/drops/filter', [DropController::class, 'filterDropsByType']);
        Route::post('/panel/dashboard/remove-drop-to-worker', [DropController::class, 'removeDropToWorker'])->name('remove.drop.worker');

        Route::get('/panel/dashboard/show-messages-all', [MessageController::class, 'show'])->name('showMessageAll');
        Route::get('/panel/dashboard/show-messages/{Id}', [MessageController::class, 'showMessageUser'])->name('showUserMessage');
        Route::get('/panel/dashboard/messages-{message}-edit', [MessageController::class, 'edit'])->name('messages.edit');
        Route::put('/panel/dashboard/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::post('/panel/dashboard/send-message', [TelegramBotController::class, 'sendMessage'])->name('sendMessage');
        Route::get('/panel/dashboard/send-message-form', [TelegramBotController::class, 'showSendMessageForm'])->name('sendMessage.telegram');

        //logs
        Route::get('/panel/dashboard/login-logs', [LogController::class, 'loginLogs'])->name('login.logs');
        Route::get('/panel/dashboard/users-logs', [LogController::class, 'usersLogs'])->name('users.logs');
        Route::get('/panel/dashboard/orders-logs', [LogController::class, 'ordersLogs'])->name('orders.logs');

        //refs
        Route::get('/orders-refund', [OrderRefController::class, 'index'])->name('orders.ref');
        Route::get('/orders/create', [OrderRefController::class, 'create'])->name('orders.create');
        Route::post('/orders-refund', [OrderRefController::class, 'store'])->name('ordersRef.store');
    });

    //perms admin or general
    Route::middleware(['admin.or.general', AdminOrGeneral::class])->group(function () {

        Route::get('/panel/ftid', [ftidController::class, 'index'])->name('ftid');
        Route::get('/panel/create-ftid', [ftidController::class, 'create'])->name('createftid');
        Route::post('/create-ftid', [ftidController::class, 'store'])->name('ftid.store');
        Route::get('/panel/ftid-{id}-edit', [ftidController::class, 'edit'])->name('editftid.edit');
        Route::put('/panel/ftid/{id}', [ftidController::class, 'update'])->name('ftid.update');
        Route::delete('/ftids/{id}', [ftidController::class, 'destroy'])->name('ftid.destroy');
    });

    //perms admin or general or worker
    Route::middleware(['access.drop.order', AccessDropsOrOrders::class])->group(function () {
        Route::get('/panel', [PageController::class, 'dashboard'])->name('dashboard');
        Route::get('/panel/profile/account', [UserController::class, 'profile'])->name('profile');
        Route::post('/panel/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/panel/profile/settings', [UserController::class, 'accountSettings'])->name('profile.settings');
        Route::post('/panel/account-settings', [UserController::class, 'changePassword'])->name('account.change.password');

        Route::get('/panel/drops', [DropController::class, 'index'])->name('drops');
        Route::get('/panel/drops/filter', [DropController::class, 'filter'])->name('drops.filter');

        Route::get('/panel/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/panel/orders/create', [OrderController::class, 'create'])->name('createorder');
        Route::post('/panel/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/panel/order/{slug}/edit', [OrderController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('editorder.edit');
        Route::put('/panel/order/{slug}', [OrderController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('order.update');
        Route::delete('/panel/orders/{slug}', [OrderController::class, 'destroy'])->where('slug', '[a-zA-Z0-9-]+')->name('orders.destroy');

        Route::get('/message/create', [MessageController::class, 'create'])->name('createmessage');
        Route::post('/drops-send-request/{slug}', [MessageController::class, 'sendRequest'])->name('sendDropRequest');
    });
});

require __DIR__ . '/auth.php';
