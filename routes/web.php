<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories',App\Http\Controllers\CategoryController::class);
Route::resource('items',App\Http\Controllers\ItemController::class);
Route::resource('transactions',App\Http\Controllers\TransactionController::class);
Route::resource('buildings', App\Http\Controllers\BuildingController::class);
Route::resource('rooms', App\Http\Controllers\RoomController::class);


