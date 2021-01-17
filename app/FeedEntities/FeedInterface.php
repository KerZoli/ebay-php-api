<?php

namespace App\FeedEntities;

use stdClass;

interface FeedInterface
{
    public function add(stdClass $data): void;

    public function getResults(): array;
}
