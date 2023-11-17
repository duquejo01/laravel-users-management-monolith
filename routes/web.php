<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function(){
    
    Route::controller(UserController::class)->group(function() {
        Route::put('/users', 'update');
        Route::post('/users', 'store');
        Route::delete('/users', 'delete');
        Route::get('/', 'list')->name('users.index');
    });
    Route::get('/user/create', function () {
        return Inertia::render('Users/EditUserPage', [
            'action' => 'create',
        ]);
    });
    
    Route::get('/user/{id}/edit', function (string $id) {
        return Inertia::render('Users/EditUserPage', [
            'user' => User::query()->where('id', '=', $id)->first(),
            'action' => 'edit',
        ]);
    });
    
    Route::get('/user/{id}/profile', function (string $id) {
        return Inertia::render('Users/SingleUserPage', [
            'user' => User::where('id', $id)->first(),
        ]);
    });
});

