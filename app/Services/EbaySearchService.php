<?php

namespace App\Services;

use EbayFeed;
use Illuminate\Support\Facades\Http;
use App\Services\SearchInterface;

class EbaySearchService implements SearchInterface
{
    public function __construct(EbayFeed $feed)
    {
        $this->feed = new EbayFeed();
    }

    public function search() {
      /*  $response = Http::get(

        );*/

       //$this->feed =
    }

    public function setFilters()
    {
        // TODO: Implement setFilters() method.
    }
}
