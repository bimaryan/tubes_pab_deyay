<?php

use App\Http\Controllers\API\Admin\DashboardController;
use App\Http\Controllers\API\Admin\DosenController;
use App\Http\Controllers\API\Admin\KelasController;
use App\Http\Controllers\API\Admin\MahasiswaController;
use App\Http\Controllers\API\Admin\MatkulController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Dosen\DosenController as DosenDosenController;
use App\Http\Controllers\API\Mahasiswa\MahasiswaController as MahasiswaMahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'store'])->name('login');

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::apiResource('logout', LogoutController::class);
    Route::prefix('admin')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::prefix('pengguna')->group(callback: function () {
            // CRUD Dosen
            Route::apiResource('dosen', DosenController::class);

            // CRUD Mahasiswa
            Route::apiResource('mahasiswa', MahasiswaController::class);
            
        });
        
        Route::apiResource('kelas', KelasController::class);

        Route::apiResource('matkul', MatkulController::class);
    });
});

Route::middleware(['auth:sanctum', 'role:Dosen'])->group(function () {
    Route::prefix('dosen')->group(function(){
        Route::apiResource('logout', LogoutController::class);
        Route::get('users', [UserController::class, 'index']);
        Route::get('kelas', [DosenDosenController::class, 'index']);
        Route::get('mahasiswa', [DosenDosenController::class, 'mahasiswa']);
    });
});

Route::middleware(['auth:sanctum', 'role:Mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->group(function(){
        Route::apiResource('logout', LogoutController::class);
        Route::get('users', [UserController::class, 'index']);
        Route::get('/', [MahasiswaMahasiswaController::class, 'index']);
    });
});
