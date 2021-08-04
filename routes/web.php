<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\auth\LoginController;


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
Route::get('/login', function() {
    return view('login');
});
Route::get('/logout', function() {
    Session::forget('user');
    return redirect('login');
});


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::post('/login', [LoginController::class, 'index'])->name('login');
Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
Route::post('/add_to_cart', [ProductController::class, 'addToCart'])->name('add_to_cart');
Route::get('/cartlist', [ProductController::class, 'cartList']);


