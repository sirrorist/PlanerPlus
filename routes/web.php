<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () 
{
    return view('welcome');
});

Route::name('user.')->group(function() {

    Route::get('/login', function() {
        if (Auth::check()) {
            return redirect()->route('user.tasks');
        }
        return view('login');
    })->name('login');

    Route::get('/register', function() {
        if (Auth::check()) {
            return redirect()->route('user.tasks');
        }
        return view('register');
    })->name('register');

    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'view'])
        ->middleware('auth')
        ->name('tasks');

    Route::get('/reports', [\App\Http\Controllers\TaskController::class, 'report'])
        ->middleware('auth')
        ->name('report');

    Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'chat'])
        ->middleware('auth')
        ->name('chat');

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/tasks/save', [\App\Http\Controllers\TaskController::class, 'view'])
        ->middleware('auth')
        ->name('tasks.save');
    
    Route::get('/tasks/edit', [\App\Http\Controllers\TaskController::class, 'view'])
        ->middleware('auth')
        ->name('tasks.edit');

    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'registrate']);
    Route::post('/tasks/save', [\App\Http\Controllers\TaskController::class, 'save'])
        ->name('tasks.save');
    
    Route::post('/tasks/edit', [\App\Http\Controllers\TaskController::class, 'edit'])
        ->name('tasks.edit');
});
