<?php

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

Route::put('/users', [UserController::class, 'update']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users', [UserController::class, 'delete']);

Route::get('/users', [UserController::class, 'renderUsersView'])->name('users.index');

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
