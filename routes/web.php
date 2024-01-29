<?php

use App\Http\Controllers\LogOutController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
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

Route::get('/', function () {
    return view('app.index');
});

Route::get('/logout', LogOutController::class)->name('logout');
Route::post('/login', SignInController::class)->name('login');
Route::post('/register', SignUpController::class)->name('register');
