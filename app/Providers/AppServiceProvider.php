<?php

namespace App\Providers;

use App\ProductFeeds\EbayFeed;
use App\Services\SearchService;
use App\Services\Type\EbaySearchService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(SearchService::class, function ($app) {
            $searchService = new SearchService(
                [
                    new EbaySearchService(new EbayFeed(), ['a' => 1, 'b' => 2]),
                ]
            );

            return $searchService;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
