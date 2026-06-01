<?php

namespace App\Providers;

use App\Models\Category;

use App\Models\Task;
use App\Policies\CategoryPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::policy(Task::class, TaskPolicy::class);
        Gate::policy(Category::class,CategoryPolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
