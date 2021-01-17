<?php

namespace App\Providers;

use App\FeedEntities\EbayFeed;
use App\Services\Feed\EbaySearch\EbaySortOrder;
use App\Services\Feed\EbaySearch\Filters\FilterFactory;
use App\Services\SearchService;
use App\Services\Feed\EbaySearch\EbaySearchService;
use Illuminate\Support\ServiceProvider;

class FeedSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(SearchService::class, function ($app) {
            $config = $app['config'];
            $feedSettings = $config->get('feeds');

            return new SearchService(
                new EbaySearchService(
                    new EbayFeed(),
                    new FilterFactory(),
                    new EbaySortOrder(),
                    $feedSettings['ebay']['base_url'],
                    $feedSettings['ebay']['service_version'],
                    $feedSettings['ebay']['app_name']
                )
                // new search service instantiation should be added here
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
