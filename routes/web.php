<?php

use App\Http\Controllers\ProductController;
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

Route::get('/',[ProductController::class,'Index'])->name('index');
Route::post('/add',[ProductController::class,'AddProduct'])->name('add.product');
Route::delete('/delete',[ProductController::class,'DeleteProduct'])->name('delete.product');