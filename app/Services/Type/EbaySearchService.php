<?php

namespace App\Services\Type;

use App\ProductFeeds\EbayFeed;
use Illuminate\Support\Facades\Http;
use App\Services\SearchInterface;

class EbaySearchService implements SearchInterface
{

    private $feed;
    private $settings;

    public function __construct(EbayFeed $feed, array $settings)
    {
        $this->feed = $feed;
        $this->settings = $settings;
    }

    public function findItemsByKeyword(string $keyword)
    {
      /*  $response = Http::get(

        );*/

        return $this->feed->addProducts([[1], [2], [3]]);
    }

    public function setFilters()
    {
        // TODO: Implement setFilters() method.
    }

    public function getFeed()
    {
        return $this->feed;
    }
}
