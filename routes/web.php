<?php

use App\Http\Controllers\loginregis;
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
    return view('welcome');
});


Route::controller(loginregis::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/users', 'users')->name('users');
    Route::post('/logout', 'logout')->name('logout');
    Route::put('/update-profile/{id}', 'updateProfile')->name('update-profile');
    Route::get('/edit-profile/{id}', 'editProfile')->name('edit-profile');
    
    
    
});
   