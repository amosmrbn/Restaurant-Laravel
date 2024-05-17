<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptDetailController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 
Route::get('/', [DashboardContoller::class, 'index'])->middleware('auth');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');

Route::prefix('/')->middleware('auth')->group(
    function (){
        Route::resource('/user', UserController::class)->middleware('checkRole:admin');
        Route::resource('/category', CategoryController::class);
        Route::resource('/menu', MenuController::class);
        Route::resource('/receipt', ReceiptController::class);
        Route::resource('/receipt-detail', ReceiptDetailController::class);
        Route::get('/report', [ReportController::class, 'index']);

    }
);