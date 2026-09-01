<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AiChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::post('/ai/chat', [AiChatController::class, 'chat'])->name('ai.chat');
