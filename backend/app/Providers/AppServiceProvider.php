<?php

namespace App\Providers;

use App\Models\Grade;
use App\Observers\GradeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('school.settings', fn () => config('school')); 
    }

    public function boot(): void
    {
        Grade::observe(GradeObserver::class);
    }
}
