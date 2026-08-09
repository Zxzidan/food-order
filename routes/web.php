<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['nama' => 'Dandi Azaidane', 'title' => 'Home']);
});

Route::get('/menu', function () {
    return view('menu', ['title' => 'Menu']);
});

Route::get('/order', function () {
    return view('order', ['title' => 'Order']);
});

Route::get('/history', function () {
    return view('history', ['title' => 'History']);
});

Route::get('/reports', function () {
    return view('reports', ['title' => 'Reports']);
});
