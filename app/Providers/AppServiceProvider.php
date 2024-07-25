<?php

namespace App\Providers;

use App\Models\forums_categories;
use App\Observers\ForumsCategoriesObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\forums_sections;
use App\Observers\ForumsSectionsObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        if (str_contains($request->url(), "/admin/"))
            Paginator::useTailwind();
        else
            Paginator::useBootstrapFive();

        forums_sections::observe(ForumsSectionsObserver::class);
        forums_categories::observe(ForumsCategoriesObserver::class);
    }
}
