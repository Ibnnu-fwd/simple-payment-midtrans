<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->name('index');
Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');
