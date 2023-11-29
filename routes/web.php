<?php

use App\Http\Controllers\loginregis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SendEmailController;


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

Route::get('/', function () {return view('cv');});


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
    Route::delete('/delete-photos/{id}', 'deletePhotos')->name('delete-photos');
 
});

Route::resource('gallery', GalleryController::class);

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/send-mail', [SendEmailController::class, 'index'])->name('kirim-email');
Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

Route::get('/cv', [loginregis::class, 'cvs'])->name('cv');