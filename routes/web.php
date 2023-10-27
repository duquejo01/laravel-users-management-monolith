<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;

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
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return Inertia::render('HomePage', [
            'name' => 'José Duque',
            'frameworks' => [
                'Laravel', 'Vue', 'Inertia', 'Javascript'
            ]
        ]);
    });

    Route::get('/users', function () {


        $usersWithPagination = User::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            // ->select('id', 'name')
            ->paginate(10)
            ->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user),
                    ],
                ];
            });

        return Inertia::render('Users/IndexPage', [
            'time' => now()->toTimeString(),
            'users' => $usersWithPagination->withQueryString(),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class),
            ],
        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/CreatePage');
    })->can('create', User::class);
    // ->middleware('can:create,App\Models\User');

    Route::get('/users/edit', function () {
        return Inertia::render('Users/EditPage');
    });

    Route::post('/users', function () {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);
        User::create($attributes);
        return redirect('/users');
    });

    Route::get('/settings', function () {
        return Inertia::render('SettingsPage');
    });
});
