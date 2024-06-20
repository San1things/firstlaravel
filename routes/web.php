<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('homepage');

Route::get('/about', function () {
    return view('about');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::post('/addtodo', [TodoController::class, 'store'])->name('storetodo');

Route::post('/updatetodo', [TodoController::class, 'update'])->name('updatetodo');

Route::get('/completetodo', [TodoController::class, 'complete'])->name('completetodo');

Route::get('/deletetodo', [TodoController::class, 'delete'])->name('deletetodo');
