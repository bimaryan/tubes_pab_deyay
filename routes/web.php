<?php

use App\Http\Controllers\WEB\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index'])->name('test');
