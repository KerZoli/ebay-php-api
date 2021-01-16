<?php

namespace App\Services\Feed;

use App\FeedEntities\FeedInterface;

interface SearchInterface
{
    public function findItemsByKeyword(string $keyword);

    public function getFeed(): FeedInterface;
}
