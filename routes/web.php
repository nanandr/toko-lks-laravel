<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;

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
Route::get('login', [FormController::class, 'login'])->name('login');
Route::post('login/auth', [AuthController::class, 'login']);

Route::get('admin/login', [FormController::class, 'adminLogin']);
Route::post('admin/login/auth', [AuthController::class, 'adminLogin']);

Route::get('register', [FormController::class, 'register']);
Route::post('register/auth', [AuthController::class, 'register']);

Route::get('admin/register', [FormController::class, 'adminRegister']);
Route::post('admin/register/auth', [AuthController::class, 'adminRegister']);


Route::middleware(['auth:customer'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::get('item/{id}', [FormController::class, 'produkView']);
    Route::put('buy/{id}', [ProdukController::class, 'buy']);
    Route::get('transaction', [HomeController::class, 'transaction']);

    Route::get('profile', [FormController::class, 'customerProfile']);
    Route::put('profile/edit/{id}', [AuthController::class, 'customerEdit']);
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin', [HomeController::class, 'admin']);
    Route::get('admin/transaction', [HomeController::class, 'transactionAdmin']);
    Route::put('admin/profile/edit/{id}', [AuthController::class, 'adminEdit']);

    Route::get('admin/item/{id}', [FormController::class, 'produkEdit']);
    Route::put('admin/product/edit/{id}', [ProdukController::class, 'produkEdit']);

    Route::get('admin/product/add', [FormController::class, 'product']);
    Route::post('admin/product/add/auth', [ProdukController::class, 'add']);
    Route::get('admin/product/delete/{id}', [ProdukController::class, 'produkDelete']);

    Route::get('admin/category/add', [FormController::class, 'category']);
    Route::post('admin/category/add/auth', [ProdukController::class, 'category']);

    Route::get('admin/profile', [FormController::class, 'adminProfile']);
    Route::get('admin/logout', [AuthController::class, 'adminLogout']);
});

