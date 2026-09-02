<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Landing Page Route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    Route::get('/payment/{order_number}', [App\Http\Controllers\PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order_number}/cash', [App\Http\Controllers\PaymentController::class, 'processCash'])->name('payment.cash');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::post('/ai/chat', [AiChatController::class, 'chat'])->name('ai.chat');
});
