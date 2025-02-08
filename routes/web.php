<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/accounting', [AccountController::class, 'index'])->name('accounting.index');
    Route::post('/accounting/account', [AccountController::class, 'createAccount'])->name('accounting.createAccount');
    Route::post('/accounting/transaction', [AccountController::class, 'createTransaction'])->name('accounting.createTransaction');
    Route::get('/accounting/{account}', [AccountController::class, 'show'])->name('accounts.show');
    Route::put('/accounting/{account}', [AccountController::class, 'update'])->name('accounts.update');

    Route::get('/transactions', [TransactionController::class, 'getTransactions'])->name('transactions.index');
    Route::get('/transactions/statistics', [TransactionController::class, 'index']);
});
