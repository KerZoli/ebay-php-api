<?php

namespace App\Services\Feed;

use App\FeedEntities\EbayFeed;
use Illuminate\Support\Facades\Http;
use App\Services\Feed\SearchInterface;

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
            $this->feed->add($item);
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
