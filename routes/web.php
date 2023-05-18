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

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users-create', [App\Http\Controllers\UserController::class, 'add'])->name('users.create');
Route::match(['get', 'post'],'/users-edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::get('/users-delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('users.delete');
Route::get('/users-view', [App\Http\Controllers\UserController::class, 'view'])->name('users.view');
