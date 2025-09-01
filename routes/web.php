<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DemitirFuncionario;
use App\Http\Controllers\FuncionarioController;
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

Route::get('/', [UserController::class, 'index'])->name('index')->middleware('check.user.type');

Route::middleware('check.user.type')->group(function () {
    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    Route::resource('funcionarios', FuncionarioController::class)->except('show');
    Route::patch('funcionarios/{funcionario}/demissao', DemitirFuncionario::class)->name('funcionarios.demitir');

    Route::resource('projetos', ProjetoController::class);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');

Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/create-user', [UserController::class, 'store'])->name('user.store');
