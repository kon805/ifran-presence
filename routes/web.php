<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;


Route::middleware(['auth:sanctum', 'verified'])->get('/redirect-by-role', function (\Illuminate\Http\Request $request) {
        $role = $request->user()->role;
        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'coordinateur' => redirect('/coordinateur'),
            'professeur' => redirect('/professeur'),
            'etudiant' => redirect('/etudiant'),
            default => abort(403),
        };
    });

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
        Route::get('/users/create', \App\Livewire\Admin\CreateUser::class)->name('admin.users.create');
    });

    Route::middleware('role:coordinateur')->prefix('coordinateur')->group(function () {
        Route::get('/', fn () => view('coordinateur.dashboard'))->name('coordinateur.dashboard');
    });

    Route::middleware('role:professeur')->prefix('professeur')->group(function () {
        Route::get('/', fn () => view('professeur.dashboard'))->name('professeur.dashboard');
    });

    Route::middleware('role:etudiant')->prefix('etudiant')->group(function () {
        Route::get('/', fn () => view('etudiant.dashboard'))->name('etudiant.dashboard');
});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
