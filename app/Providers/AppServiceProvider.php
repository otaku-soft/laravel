<?php

namespace App\Providers;

use App\Models\ForumsCategories;
use App\Observers\ForumsCategoriesObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\ForumsSections;
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

        ForumsSections::observe(ForumsSectionsObserver::class);
        ForumsCategories::observe(ForumsCategoriesObserver::class);
    }
}
