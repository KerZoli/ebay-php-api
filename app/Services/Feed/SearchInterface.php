<?php

namespace App\Services\Feed;

interface SearchInterface
{
    public function setFilters();

    public function findItemsByKeyword(string $keyword);
}
