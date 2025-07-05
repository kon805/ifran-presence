<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

     public const HOME = '/redirect-by-role';

public function boot()
{
    Route::middleware('web')
        ->get('/redirect-by-role', function () {
            $user = \Illuminate\Support\Facades\Auth::user();
            return match ($user->role) {
                'admin' => redirect('/admin/dashboard'),
                'coordinateur' => redirect('/coordinateur'),
                'professeur' => redirect('/professeur'),
                'etudiant' => redirect('/etudiant'),
                default => abort(403),
            };
        });
}

    public function register(): void
    {
        //
    }


}
