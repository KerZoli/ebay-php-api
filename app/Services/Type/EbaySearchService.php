<?php

namespace App\Services\Type;

use App\ProductFeeds\Feeds\EbayFeed;
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

        $result = [[1], [2], [3]];
        foreach ($result as $item) {
            $this->feed->addProduct($item);
        }
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
