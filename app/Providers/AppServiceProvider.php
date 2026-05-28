<?php

namespace App\Providers;

use App\Models\Registration;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('admin.layout', function ($view): void {
            if (! auth()->check()) {
                return;
            }

            $view->with('pendingRegistrationsCount', Registration::query()
                ->where('status', 'pending')
                ->count());
        });
    }
}
