<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('/after-payment', [OrderController::class, 'afterPayment'])->name('after-payment');
