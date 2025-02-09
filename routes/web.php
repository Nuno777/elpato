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

    Route::middleware(['admin', Admin::class])->group(function () {
        Route::get('/panel/enable-2fa', [UserController::class, 'enable2fa'])->name('enable-2fa');
        Route::post('/panel/verify-2fa', [UserController::class, 'verify2FA'])->name('verify-2fa.submit');

        Route::get('/panel/control-panel/drops', [DropController::class, 'create'])->name('createdrops');
        Route::post('/panel/control-panel/drops', [DropController::class, 'store'])->name('createdrops.store');
        Route::get('/panel/control-panel/drops/{slug}/edit', [DropController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('editdrops.edit');
        Route::put('/panel/control-panel/drops/{slug}', [DropController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('drops.update');

        Route::post('/panel/control-panel/assign-drop-to-worker', [DropController::class, 'assignDropToWorker'])->name('assign.worker.drop');
        Route::get('/panel/control-panel/drops/filter', [DropController::class, 'filterDropsByType']);
        Route::post('/panel/control-panel/drops/get-drops-for-worker', [DropController::class, 'getDropsForWorker'])->name('get.drops.for.worker');
    });

    //perms admin
    Route::middleware(['admin', '2fa', Admin::class])->group(function () {
        Route::get('/panel/control-panel', [PageController::class, 'adminpainel'])->name('adminpainel');

        Route::delete('/panel/control-panel/drops/{slug}', [DropController::class, 'destroy'])->name('drops.destroy');

        Route::get('/panel/control-panel/order/status/{slug}/edit', [OrderController::class, 'statusedit'])->where('slug', '[a-zA-Z0-9-]+')->name('editorderstatus.edit');
        Route::put('/panel/control-panel/order/status/{slug}', [OrderController::class, 'statusupdate'])->where('slug', '[a-zA-Z0-9-]+')->name('orderstatus.update');
        Route::get('/panel/control-panel/orders/show', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/panel/control-panel/all-orders', [OrderController::class, 'allshow'])->name('orders.all');
        Route::get('/panel/control-panel/orders/filter', [OrderController::class, 'filterOrders'])->name('orders.filter');

        //restore order
        Route::put('/panel/control-panel/orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::get('/panel/control-panel/orders-softdeleted', [OrderController::class, 'allShowDeleted'])->name('orders.deleted');
        Route::delete('/panel/control-panel/orders/{slug}/force-delete', [OrderController::class, 'forceDelete'])->where('slug', '[a-zA-Z0-9-]+')->name('orders.forceDelete');

        Route::get('/panel/control-panel/all-ftid', [ftidController::class, 'allshow'])->name('ftid.all');
        Route::get('/panel/control-panel/ftid/filter', [ftidController::class, 'filterFTID'])->name('ftid.filter');
        Route::get('/panel/control-panel/ftid-status-{id}-edit', [ftidController::class, 'statusedit'])->name('editftidstatus.edit');
        Route::put('/panel/control-panel/ftid-status/{id}', [ftidController::class, 'statusupdate'])->name('ftidstatus.update');

        Route::get('/panel/control-panel/create-user', [UserController::class, 'index'])->name('createuser');
        Route::get('/panel/control-panel/create-user', [UserController::class, 'create'])->name('createuser');
        Route::post('/panel/control-panel/create-user', [UserController::class, 'store'])->name('createuser.store');
        Route::get('/panel/control-panel/user-{slug}-edit', [UserController::class, 'edit'])->where('slug', '[a-zA-Z0-9-]+')->name('edituser.edit');
        Route::put('/panel/control-panel/user/{slug}', [UserController::class, 'update'])->where('slug', '[a-zA-Z0-9-]+')->name('user.update');
        Route::get('/panel/control-panel/all-users', [UserController::class, 'allshow'])->name('user.all');
        Route::delete('/panel/control-panel/user/{slug}', [UserController::class, 'destroy'])->where('slug', '[a-zA-Z0-9-]+')->name('user.destroy');
        Route::get('/panel/control-panel/user/filter', [UserController::class, 'filterUser'])->name('user.filter');
        Route::post('/panel/control-panel/user-{slug}-set-default-password', [UserController::class, 'setDefaultPassword'])->where('slug', '[a-zA-Z0-9-]+')->name('user.setDefaultPassword');
        Route::post('/panel/control-panel/validate-password', [UserController::class, 'validatePassword']);

        Route::post('/send-verification-code/{slug}', [UserController::class, 'sendVerificationCode']);
        Route::post('/verify-code/{slug}', [UserController::class, 'verifyCode']);


        //restore users
        Route::put('/panel/control-panel/user/{slug}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::get('/panel/control-panel/user-softdeleted', [UserController::class, 'allShowDeleted'])->name('user.deleted');
        Route::delete('/panel/control-panel/user/{slug}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');

        Route::get('/panel/control-panel/users-orders-{slug}', [OrderController::class, 'showUserOrders'])->where('slug', '[a-zA-Z0-9-]+')->name('user.orders');
        Route::get('/panel/control-panel/users-ftids-{slug}', [ftidController::class, 'showUserFtids'])->name('user.ftids');
        Route::get('/panel/control-panel/users-drops-{slug}', [DropController::class, 'showUserDrops'])->where('slug', '[a-zA-Z0-9-]+')->name('user.drops');

        Route::post('/panel/control-panel/remove-drop-to-worker', [DropController::class, 'removeDropToWorker'])->name('remove.drop.worker');

        Route::get('/panel/control-panel/show-messages-all', [MessageController::class, 'show'])->name('showMessageAll');
        Route::get('/panel/control-panel/show-messages/{Id}', [MessageController::class, 'showMessageUser'])->name('showUserMessage');
        Route::get('/panel/control-panel/messages-{message}-edit', [MessageController::class, 'edit'])->name('messages.edit');
        Route::put('/panel/control-panel/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::post('/panel/control-panel/send-message', [TelegramBotController::class, 'sendMessage'])->name('sendMessage');
        Route::get('/panel/control-panel/send-message-form', [TelegramBotController::class, 'showSendMessageForm'])->name('sendMessage.telegram');

        //logs
        Route::get('/panel/control-panel/login-logs', [LogController::class, 'loginLogs'])->name('login.logs');
        Route::get('/panel/control-panel/users-logs', [LogController::class, 'usersLogs'])->name('users.logs');
        Route::get('/panel/control-panel/orders-logs', [LogController::class, 'ordersLogs'])->name('orders.logs');

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
