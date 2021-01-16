<?php

namespace App\FeedEntities;

interface FeedInterface
{
    public function add(array $data);

    public function getResults();
}
