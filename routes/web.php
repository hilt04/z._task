<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjetoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded within the "web" middleware group which includes
| sessions, cookie encryption, and more. Go build something great!
|
*/

Route::get('/', [UserController::class, 'dashboard'])->name('index')->middleware('check.user.type');

Route::middleware('check.user.type')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('employees', EmployeeController::class)->except('show');
    Route::patch('employees/{employee}/dismiss', [EmployeeController::class, 'dismiss'])->name('employees.dismiss');
    Route::resource('projetos', ProjetoController::class);
    Route::resource('users', UserController::class);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
