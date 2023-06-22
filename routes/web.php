<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UsersController;

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

Route::get('/', [TodoController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/welcome', [TodoController::class, 'index'])->middleware(['auth']);
Route::get('/todos', [TodoController::class, 'index'])->name('todos')
->middleware(['auth']);
Route::get('/users', [UsersController::class, 'index'])->name('users')
->middleware(['auth']);
Route::post('/create-user', [UsersController::class, 'store']);
Route::post('/create-todo', [TodoController::class, 'store'])->name('createTodo')
->middleware(['auth']);
Route::get('/create-user', [UsersController::class, 'create'])->name('create-user')
->middleware(['auth']);
Route::post('/userEdit/{id}', [UsersController::class, 'edit'])
->middleware(['auth']);
Route::post('/todoEdit/{id}', [TodoController::class, 'edit'])
->middleware(['auth']);
Route::get('/userEdit/{id}', [UsersController::class, 'view'])
->middleware(['auth']);
Route::post('/userDelete/{id}', [UsersController::class, 'destroy'])
->middleware(['auth']);
Route::post('/todoDelete/{id}', [TodoController::class, 'destroy'])
->middleware(['auth']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/delete/{id}', [loginController::class, 'deleteMyAccount'])->middleware(['auth']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/register', [registerController::class, 'register'])->name('register');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/mail',[MailController::class, 'html_mail']);


