<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\BroadcastController;
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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'back.pages.admin.auth.login')->name('login');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot-password', 'back.pages.admin.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [AdminController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [AdminController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [AdminController::class, 'resetPasswordHandler'])->name('reset-password-handler');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'back.pages.admin.home')->name('home');
        Route::post('/logout_handler', [AdminController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile', [AdminController::class, 'profileView'])->name('profile');
        Route::get('/kuesioner', [QuestionnaireController::class, 'index'])->name('kuesioner');
        Route::post('/kuesioner-form', [QuestionnaireController::class, 'kuesioner_form'])->name("kuesioner-form");
        Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast');
        Route::post('/broadcast-action', [BroadcastController::class, 'broadcast_email'])->name('broadcast-action');
    });

    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
});
